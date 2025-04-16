# Wedding Management Site Documentation

## Project Overview and Purpose
The "WeddingManagementSite" repository is a comprehensive website designed to help users plan and manage their weddings. It provides a variety of functionalities to organize and manage wedding-related tasks, serving as an all-in-one tool for wedding planning.

## Installation and Setup Instructions

### Prerequisites
- **Web Server**: Apache (recommended)
- **PHP**: Version 7.4 or higher
- **Docker**: (Optional) For containerized deployment

### Steps to Install and Set Up

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/WeddingManagementSite.git
   cd WeddingManagementSite
   ```

2. **Set Up Environment**
   - Ensure you have Apache and PHP installed and configured.
   - Place the project files in your web server's root directory (e.g., `htdocs` for XAMPP).

3. **Configure `.htaccess`**
   - Ensure the `.htaccess` file is correctly configured for URL rewriting and access control.

4. **Build Docker Image (Optional)**
   - If using Docker, build the image using the provided `Dockerfile`.
   ```bash
   docker build -t wedding-management-site .
   ```

5. **Run the Application**
   - Start your web server and navigate to the project directory in your browser.
   - Alternatively, run the Docker container:
   ```bash
   docker run -p 8080:80 wedding-management-site
   ```

## Key Features and Usage Examples

### Main Features
- **Task Management**: Organize and track wedding-related tasks.
- **Resource Attribution**: Properly attribute third-party resources used in the project.
- **Static File Management**: Easily manage CSS, JavaScript, and other assets.
- **Image Uploads**: Upload and manage images used in the website.

### Usage Examples

- **Accessing the Site**: Navigate to `http://localhost/WeddingManagementSite` in your browser.
- **Routing**: The `routes.php` file defines the routing logic. For example, accessing `/tasks` might display a list of wedding tasks.
- **Static Files**: CSS and JavaScript files are located in the `static` directory. Modify these files to customize the site's appearance and behavior.
- **Image Uploads**: Upload images to the `uploads/images` directory to use them in the website.

## Important Notes and Considerations

- **Dependencies**: Ensure all necessary dependencies are installed and configured. Typical PHP projects may require a web server, PHP runtime, and possibly a database.
- **Attributions**: Always check and update the `attributions.txt` file to ensure proper attribution of third-party resources.
- **Security**: Regularly update and secure your web server and PHP runtime to protect against vulnerabilities.
- **Docker**: Using Docker can simplify deployment and ensure consistency across different environments.

By following these guidelines, you should be able to successfully install, set up, and use the Wedding Management Site to plan and manage your wedding effectively.
