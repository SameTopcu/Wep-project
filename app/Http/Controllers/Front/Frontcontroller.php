<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Models\WelcomeItem;
use App\Models\Feature;
use App\Models\CounterItem;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\TeamMember;
use App\Models\Post;
use App\Models\BlogCategories;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use App\Models\Packages;
use App\Models\PackageAmenity;
use App\Models\Amenity;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageFaq;
use App\Models\Tour;
use App\Models\Booking;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class Frontcontroller extends Controller
{
    public function home(){
        $sliders = Slider::get();
        $counter_item = CounterItem::where('id', 1)->first();
        $welcome_item = WelcomeItem::where('id', 1)->first();
        $features = Feature::get();
        $testimonials = Testimonial::get();
        $destinations = Destination::orderBy('view_count','desc')->get()->take(8);
        $posts = Post::with('blog_category')->orderBy('id','desc')->get()->take(3);
        return view("front.home",compact('sliders','welcome_item','features','counter_item','testimonials','posts','destinations'));
    }

    public function about(){
        $welcome_item = WelcomeItem::where('id',1)->first();
        $features = Feature::get();
        $counter_item = CounterItem::where('id', 1)->first();
        return view("front.about",compact('welcome_item','features','counter_item'));
    }

    public function registration(){
        return view("front.registration");
    }

    public function registration_submit(Request $request) {
        // 1. Validasyon: Email'in benzersiz (unique) olduğunu kontrol et
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "retype_password" => "required|same:password",
        ], [
            // Türkçe hata mesajları (İsteğe bağlı)
            "email.unique" => "Bu email adresi zaten sistemde kayıtlı.",
            "retype_password.same" => "Şifreler birbiriyle uyuşmuyor."
        ]);
    
        // 2. Güvenli Token Oluşturma
        $token = hash('sha256', time());
    
        // 3. Kullanıcı Kaydı
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // bcrypt yerine Hash::make daha standarttır
        $user->token = $token;
        $user->status = 0; // Kullanıcıyı başlangıçta onaylanmamış (pasif) yapıyoruz
        $user->save();
    
        // 4. Doğrulama Linki Oluşturma
        // Not: web.php dosyasında bu rotanın parametrelerini kontrol etmelisin
        $verification_link = route('registration_verify', ['email' => $request->email, 'token' => $token]);
    
        // 5. E-posta Gönderimi
        $subject = "User Account Verification";
        $message = 'Please click the following link to verify your email address:<br>';
        $message .= '<a href="'.$verification_link.'">Verify Email</a>';
    
        try {
            Mail::to($request->email)->send(new Websitemail($subject, $message));
        } catch (\Exception $e) {
            // Mail gitmezse kullanıcıyı bilgilendirebilir veya kaydı silebilirsin
            return redirect()->back()->with('error', 'Mail gönderilirken bir sorun oluştu.');
        }
    
        return redirect()->route('login')->with('success', 'Registration is successful, but you have to verify your address to login so please check your email to confirm the verification link.');
    }
    public function registration_verify($email,$token){
         $user = User::where('token',$token)->where('email',$email)->first();
         if(!$user) {
             return redirect()->route('login');
         }
         $user->token = '';
         $user->status = 1;
         $user->update();
     
         return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }
    public function login(){
        return view ("front.login");
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email adresi gereklidir.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'password.required' => 'Şifre gereklidir.',
        ]);
    
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'status'=>1,
        ];
    
        if(Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with('success', 'Giriş başarılı!');
        } else {
            return redirect()->route('login')->with('error','Girdiğiniz bilgiler hatalı! Lütfen tekrar deneyiniz!')->withInput();

        } 
    }


    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Logout is successfull');
    }

    public function forget_password(){
        return view('front.forget-password');
    }
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email is not found');
        }
    
        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();
    
        $reset_link=route('reset_password',['token'=> $token,'email'=>$request->email]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";
    
        Mail::to($request->email)->send(new Websitemail($subject,$message));
    
        return redirect()->back()->with('success','We have sent a password reset link to your email. Please check your email.');
    }


    public function reset_password(string $token, string $email){
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired reset link.');
        }

        return view('front.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, string $token, string $email)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'retype_password' => ['required', 'same:password'],
        ], [
            'password.required' => 'Şifre gereklidir.',
            'confirm_password.required' => 'Şifre doğrulama gereklidir.',
            'confirm_password.same' => 'Şifreler uyuşmuyor.',
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Geçersiz veya süresi dolmuş link.');
        }
    
        // DÜZELTME: Hash::make() KALDIRILDI.
        // User modelindeki 'casts' özelliği bunu otomatik şifreleyecek.
        $user->password = $request->password; 
        
        $user->token = ''; 
        $user->save();
    
        return redirect()->route('login')->with('success', 'Şifreniz başarıyla güncellendi. Giriş yapabilirsiniz.');
    }

    public function team_members(){
        $team_members = TeamMember::paginate(4);
        return view('front.team_members',compact('team_members'));
    }

    public function team_member($slug){
        $team_member = TeamMember::where('slug',$slug)->first();
        return view('front.team_member',compact('team_member'));
    }

    public function faq(){
        $faqs = Faq::get();
        return view('front.faq',compact('faqs'));
    }

    public function blog(){
        $posts = Post::with('blog_category')->paginate(4);
        return view('front.blog',compact('posts'));
    }

    public function post($slug){
        $categories = BlogCategories::orderBy('name','asc')->get();
        $post = Post::where('slug',$slug)->first();
        $latest_posts = Post::with('blog_category')->orderBy('id','desc')->get()->take(5);
        return view('front.post',compact('post','categories','latest_posts'));
    }
    
    public function category($slug){

        $category = BlogCategories::where('slug',$slug)->first();
        $posts = Post::where('blog_category_id',$category->id)->orderBy('id','desc')->paginate(9);
        return view('front.category',compact('posts','category'));
    }


    public function destinations(){
        $destinations = Destination::orderBy('id','asc')->paginate(20);
        return view('front.destinations',compact('destinations'));
    }

    public function destination($slug){
        $destination = Destination::where('slug',$slug)->first();
        $destination->view_count = $destination->view_count + 1;
        $destination->update();
        $destination_photos = DestinationPhoto::where('destination_id',$destination->id)->get();
        $destination_videos = DestinationVideo::where('destination_id',$destination->id)->get()->take(2);
        return view('front.destination',compact('destination','destination_photos','destination_videos'));
    }

    public function package($slug)
    {
        $package = Packages::where('slug',$slug)->first();
        $package_itineraries=PackageItinerary::where('package_id',$package->id)->get();
        $package_photos=PackagePhoto::where('package_id',$package->id)->get();
        $package_videos=PackageVideo::where('package_id',$package->id)->get();
        $package_faqs=PackageFaq::where('package_id',$package->id)->get();
        $tours=Tour::where('package_id',$package->id)->get();
        $package_amenities_include=PackageAmenity::with('amenity')->where('package_id',$package->id)->where('type','include')->get();
        $package_amenities_exclude=PackageAmenity::with('amenity')->where('package_id',$package->id)->where('type','exclude')->get();
        return view('front.package',compact('package','package_amenities_include','package_amenities_exclude','package_itineraries','package_photos','package_videos','package_faqs','tours'));
    }

    public function payment(Request $request)
    {
        //check the tour selection
        if(!$request->tour_id){

            return redirect()->back()->with('error','Please select a tour first!');

        }



        //check the seat availability

        $tour_data = Tour::where('id', $request->tour_id)->first();
        $tour_allowed_seats = $tour_data->tour_total_seat;

        if ($tour_allowed_seats > 0) {
            $total_booked_seats = Booking::where('tour_id', $request->tour_id)
                ->where('package_id', $request->package_id)
                ->sum('total_person');

            $remaining_seats = $tour_allowed_seats - $total_booked_seats;

            if ($request->total_person > $remaining_seats) {
                return redirect()->back()->with('error', 'Bu tur için sadece ' . $remaining_seats . ' koltuk kaldı. Lütfen kişi sayısını buna göre ayarlayın.');
            }
        }

        
        
        $request->validate([
            'payment_method' => 'required',
            'total_person' => 'required|integer|min:1',
        ]);

        $user_id = Auth::guard('web')->user()->id;
        $package = Packages::where('id', $request->package_id)->first();
        $total_price = $request->ticket_price * $request->total_person;

        session()->put('total_person', $request->total_person);
        session()->put('tour_id', $request->tour_id);
        session()->put('user_id', $user_id);
        session()->put('package_id', $package->id);
        session()->put('paid_amount', $total_price);

        if ($request->payment_method == 'PayPal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_price,
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            return redirect()->route('paypal_cancel');
        }
        elseif ($request->payment_method == 'Stripe') {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $package->name,
                            ],
                            'unit_amount' => $total_price * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe_success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe_cancel'),
            ]);

            if (isset($response->id) && $response->id != '') {
                return redirect($response->url);
            }

            return redirect()->route('stripe_cancel');
        }

        return redirect()->back()->with('error', 'Invalid payment method.');
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $obj = new Booking();
            $obj->tour_id = session()->get('tour_id');
            $obj->package_id = session()->get('package_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $obj->invoice_no = time();
            $obj->payment_status = 'COMPLETED';
            $obj->payment_method = 'PayPal';
            $obj->save();

            session()->forget(['total_person', 'tour_id', 'user_id', 'package_id', 'paid_amount']);

            return redirect()->route('home')->with('success', 'Payment is successful.');
        }

        return redirect()->route('paypal_cancel');
    }

    public function paypal_cancel()
    {
        session()->forget(['total_person', 'tour_id', 'user_id', 'package_id', 'paid_amount']);
        return redirect()->route('home')->with('error', 'Payment is cancelled.');
    }

    public function stripe_success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($session->payment_status == 'paid') {
            $obj = new Booking();
            $obj->tour_id = session()->get('tour_id');
            $obj->package_id = session()->get('package_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->paid_amount = session()->get('paid_amount');
            $obj->invoice_no = time();
            $obj->payment_status = 'COMPLETED';
            $obj->payment_method = 'Stripe';
            $obj->save();

            session()->forget(['total_person', 'tour_id', 'user_id', 'package_id', 'paid_amount']);

            return redirect()->route('home')->with('success', 'Payment is successful.');
        }

        return redirect()->route('stripe_cancel');
    }

    public function stripe_cancel()
    {
        session()->forget(['total_person', 'tour_id', 'user_id', 'package_id', 'paid_amount']);
        return redirect()->route('home')->with('error', 'Payment is cancelled.');
    }
}