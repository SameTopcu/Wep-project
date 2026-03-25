# Travel Agency Management System

A comprehensive Travel Agency and Tour Booking Management System built with Laravel. This platform provides a complete solution for managing travel destinations, tour packages, bookings, customer interactions, and more.

## Features

### Frontend (User Facing)
- **Dynamic Home Page:** Customizable sections (Destinations, Packages, Testimonials, Blog, Features) managed directly from the admin panel.
- **Destinations & Packages:** Browse various travel destinations and explore detailed tour packages.
- **Advanced Filtering:** Filter packages by name, price range, destination, and review ratings.
- **Package Details:** View itineraries, photo/video galleries, included/excluded amenities, FAQs, and interactive maps.
- **Booking System:** Seamless booking flow with real-time seat availability checks.
- **Payment Integration:** Secure payments via Stripe, PayPal, or Cash.
- **Reviews & Ratings:** Customers can leave ratings and comments on completed tours.
- **Blog & News:** Read the latest updates and travel tips.
- **Wishlist:** Save favorite packages for later.
- **Newsletter Subscription:** Subscribe to get the latest travel news (with email verification).

### User Panel (Customer Dashboard)
- **Profile Management:** Update personal information and profile picture.
- **My Bookings & Invoices:** Track booking history, payment status, and download/print dynamic invoices.
- **My Reviews:** View and manage submitted reviews.
- **My Wishlist:** Quick access to saved packages.
- **Messaging System:** Direct communication channel with the admin team.

### Admin Panel (Management Dashboard)
- **Home Page Items:** Dynamically update headings, subheadings, and section visibility on the frontend.
- **Destinations Management:** Add, edit, and delete destinations with associated media.
- **Packages & Tours Management:** Create detailed packages, manage daily itineraries, FAQs, media, and schedule multiple tours under a package.
- **Booking Management:** Track all customer bookings, payment statuses (Pending/Completed), and manage cancellations.
- **User Management:** View registered users and their activities.
- **Review & Message Management:** Moderate user reviews, view incoming customer messages, and reply directly via email.
- **Newsletter / Subscribers:** Manage email subscribers and send bulk promotional emails.
- **Blog Management:** Manage blog categories and posts.
- **General Settings:** Manage sliders, features, testimonials, FAQs, and counter items.

## Technologies Used
- **Backend:** Laravel (PHP)
- **Database:** MySQL
- **Frontend:** Blade Templating, HTML5, CSS3, Bootstrap, jQuery, Select2, Owl Carousel, SweetAlert2
- **Payment Gateways:** Stripe API, PayPal API

## Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/SameTopcu/Wep-project.git
   cd Wep-project
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   Copy the `.env.example` file to `.env` and configure your database, mail, and payment gateway credentials.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Run the Application**
   ```bash
   php artisan serve
   ```
   *For frontend assets compiling, run: `npm run dev` or `npm run build`*

## Security
- Sensitive credentials (Stripe, PayPal) should be kept strictly in `.env`.
- Cross-Site Request Forgery (CSRF) protection is enabled on all forms.
- SQL Injection protection via Laravel Eloquent ORM.

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
