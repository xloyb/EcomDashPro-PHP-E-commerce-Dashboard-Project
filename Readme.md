# EcomDashPro

## EcomDashPro PHP E-commerce Dashboard Project 

### Project Overview
EcomDashPro is an innovative e-commerce platform designed to provide a seamless shopping experience. It features dedicated admin and user dashboards, each offering unique functionalities to enhance the management and shopping processes.

### Admin Dashboard
The admin dashboard caters to different administrative roles defined by the `adminlevel` column in the database:
- **User (adminlevel 0):** Basic Client.
- **Moderator (adminlevel 1):** Additional moderation capabilities. (Conceptual and not included in the project)
- **Administrator (adminlevel 3):** Full administrative control.
Administrators have comprehensive tools for efficiently managing products and categories, including adding, editing, and deleting functionalities.

### User Dashboard
The user dashboard prioritizes an enhanced shopping experience. Users can effortlessly add products to their shopping carts and adjust quantities or remove items as needed.

### Security Measures
Our commitment to security includes robust measures to fortify against potential vulnerabilities, ensuring the integrity of our system.

### Frontend Framework
EcomDashPro's frontend development is crafted using the vibrant Tailwind CSS framework. This choice ensures responsiveness and contributes to a visually appealing and dynamic user interface.

### Debugging Methods
We've retained our debugging methods to provide visibility into the site's functionality:
- **session.php:** Displays sessions' saved variables, including debugging echos and alerts for insights into inc/auth.php workings.

### Configuration in inc/Settings.php
Adjust the links in inc/Settings.php according to your LocalHost project root path. Below are our configurations as an example:
```php
$settings['products_img_path'] = "http://localhost/v2/images/articles/";
$settings['domain'] = "http://localhost/v2/";
$settings['user_dash'] = "http://localhost/v2/dashboard/user_dashboard.php";
$settings['css_path'] = "http://localhost/v2/css/output.css";
```

## Admin Dashboard and Functions
All components related to the admin dashboard and its associated functions are concentrated in the `/admin` directory.

## Client Dashboard and Card
The client dashboard is accessible at `/dashboard/`. The functions and associated files are organized as follows:

- **Functions:** `inc/user_functions.php`
- **Dashboard Templates and Components:**
  - `inc/dash_products.php`
  - `inc/dynamicpages.php`
  - `inc/staticpages.php`


## Tailwind CSS Integration
Tailwind CSS has been removed from the root, but you can reintegrate it using the following steps:

- **Installation:** Refer to the Tailwind CSS Installation Guide for detailed instructions.
- **Plugin Installation:** After installing Tailwind CSS, add the following plugins:
  ```bash
  npm install @tailwindcss/aspect-ratio @tailwindcss/forms
  ```

### Configuration
Replace the contents of `tailwind.config.js` with the following:

```javascript
module.exports = {
  content: [
    "./admin/dashboard/**/*.php",
    "./dashboard/**/*.php",
    "./inc/**/*.php",
    "./*.php",
  ],
  theme: {
    extend: {},
  },
};
```
## Contributors
- [xLoy](https://github.com/mydevify)
-  [MaissaHnaiech](https://github.com/MaissaHnaiech)
-  [Dinaaliyoussef](https://github.com/Dinaaliyoussef)


This project is not intended for production use but rather as an educational resource to understand how PHP works. By comprehensively understanding this project, you will gain proficiency in PHP basics.
