# Admin Panel Bootstrap 5 Redesign

This project involves redesigning the admin control panel using Bootstrap 5 to create a modern, responsive UI/UX.

## Overview

The admin panel has been updated with Bootstrap 5 components and utilities to improve the visual appeal, usability, and mobile responsiveness. The redesign focuses on the navigation sidebar, header, and footer components.

## Key Features

- **Modern UI**: Clean, professional design using Bootstrap 5 components
- **Responsive Layout**: Mobile-first approach with responsive breakpoints
- **Dark Mode Support**: Toggle between light and dark themes
- **Improved Navigation**: Collapsible sidebar with smooth transitions
- **Interactive Components**: Dropdowns, cards, and other interactive elements
- **Accessibility Improvements**: ARIA attributes and keyboard navigation

## Files Modified

- `include/header.inc.php`: Updated with Bootstrap 5 navbar
- `include/navigation.inc.php`: Redesigned sidebar with Bootstrap 5 classes
- `include/footer.inc.php`: Updated scripts and dependencies
- `js/dark-mode.js`: Enhanced for Bootstrap 5 compatibility
- `css/bootstrap-admin.css`: Updated styles for Bootstrap 5
- `css/bootstrap5-custom.css`: Additional custom styles

## New Components

### Navigation Sidebar

The sidebar now features:
- User profile section with avatar and status indicator
- Collapsible menu items with icons
- Search functionality
- Mobile-responsive behavior with backdrop overlay
- Smooth transitions and animations

### Header

The header includes:
- Responsive navbar with Bootstrap 5 components
- Sidebar toggle button for mobile devices
- User dropdown menu with profile options
- Dark mode toggle button
- Notification indicators

### Dashboard Components

The `dashboard-demo.php` file demonstrates various Bootstrap 5 components:
- Info boxes with gradients and statistics
- Cards with various styles and headers
- Responsive tables with Bootstrap 5 styling
- Timeline component for activity logs
- Charts using Chart.js (compatible with dark mode)
- Quick action buttons and system information

## Usage

### Basic Structure

```html
<!-- Page Structure -->
<?php include_once 'include/header.inc.php'; ?>
<?php include_once 'include/navigation.inc.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="m-0">Page Title</h1>
                    <!-- Breadcrumbs -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-2">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Current Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Your content here -->
        </div>
    </div>
</div>

<?php include_once 'include/footer.inc.php'; ?>
```

### Card Component

```html
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Card Title</h3>
        <div class="card-tools">
            <!-- Optional card tools -->
            <button type="button" class="btn btn-tool" data-bs-toggle="card-collapse">
                <i class="fa-solid fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        Card content goes here
    </div>
    <div class="card-footer">
        Card footer content
    </div>
</div>
```

### Info Box Component

```html
<div class="info-box">
    <div class="info-box-icon bg-primary-gradient">
        <i class="fa-solid fa-users"></i>
    </div>
    <div class="info-box-content">
        <span class="info-box-text">Title</span>
        <span class="info-box-number">Value</span>
        <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"></div>
        </div>
        <span class="text-muted small">Additional info</span>
    </div>
</div>
```

### Timeline Component

```html
<div class="timeline">
    <div class="timeline-item">
        <div class="timeline-icon bg-primary">
            <i class="fa-solid fa-user-plus text-white"></i>
        </div>
        <div class="timeline-body">
            <div class="d-flex justify-content-between">
                <h6 class="mb-0">Event Title</h6>
                <span class="timeline-time">Time</span>
            </div>
            <p class="text-muted mb-0">Event description</p>
        </div>
    </div>
    <!-- More timeline items -->
</div>
```

## Dark Mode

The dark mode toggle is implemented using Bootstrap 5's theme system. It can be activated by:

1. Clicking the dark mode toggle button in the header
2. Using the mobile menu toggle switch
3. Following the system preference (if no manual preference is set)

The theme is stored in localStorage as 'vclub-theme' and applied using the `data-bs-theme` attribute.

## Dependencies

- Bootstrap 5.3.0 (CSS and JS)
- Font Awesome 6 (for icons)
- jQuery 3.6.0 (for Bootstrap plugins)
- Popper.js (included with Bootstrap bundle)
- Chart.js (for dashboard charts)
- DataTables (with Bootstrap 5 styling)

## Browser Compatibility

The redesign is compatible with modern browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Future Improvements

- Complete integration with all admin pages
- Enhanced accessibility features
- Additional interactive components
- Performance optimizations
- Expanded dark mode support for all components
