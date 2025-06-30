/**
 * SweetAlert Helper Functions
 * Replaces standard JavaScript alerts with SweetAlert2 popups
 */

// Global variable to track if an alert is currently showing
let isAlertShowing = false;

// Function to show alert with SweetAlert2
function showSweetAlert(message, type = 'info', title = '', redirect = '') {
  // Set default title based on type if not provided
  if (!title) {
    switch (type) {
      case 'success':
        title = 'Success';
        break;
      case 'error':
        title = 'Error';
        break;
      case 'warning':
        title = 'Warning';
        break;
      case 'info':
        title = 'Information';
        break;
      default:
        title = 'Notice';
    }
  }

  // Prevent multiple alerts from showing at once
  if (isAlertShowing) {
    // If there's already an alert and we need to redirect, do it immediately
    if (redirect) {
      window.location = redirect;
    }
    return Promise.resolve();
  }

  isAlertShowing = true;

  // Configure SweetAlert options
  return Swal.fire({
    title: title,
    text: message,
    icon: type,
    confirmButtonColor: '#3085d6',
    showClass: {
      popup: 'animate__animated animate__fadeInUp animate__faster'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutDown animate__faster'
    }
  }).then(() => {
    isAlertShowing = false;
    // Handle redirect after alert is closed if provided
    if (redirect) {
      window.location = redirect;
    }
  });
}

// Function to show success message
function showSuccessAlert(message, title = 'Success', redirect = '') {
  return showSweetAlert(message, 'success', title, redirect);
}

// Function to show error message
function showErrorAlert(message, title = 'Error', redirect = '') {
  return showSweetAlert(message, 'error', title, redirect);
}

// Function to show warning message
function showWarningAlert(message, title = 'Warning', redirect = '') {
  return showSweetAlert(message, 'warning', title, redirect);
}

// Function to show info message
function showInfoAlert(message, title = 'Information', redirect = '') {
  return showSweetAlert(message, 'info', title, redirect);
}

// Function to show confirmation dialog
function showConfirmAlert(message, title = 'Confirm', confirmText = 'Yes', cancelText = 'No') {
  if (isAlertShowing) return Promise.resolve(false);
  
  isAlertShowing = true;
  
  return Swal.fire({
    title: title,
    text: message,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: confirmText,
    cancelButtonText: cancelText,
    showClass: {
      popup: 'animate__animated animate__fadeInUp animate__faster'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutDown animate__faster'
    }
  }).then((result) => {
    isAlertShowing = false;
    return result.isConfirmed;
  });
}

// Flag to track if we've already processed alerts on this page
let alertsProcessed = false;

// Function to parse PHP-generated alert scripts and convert them to SweetAlert calls
function convertPHPAlerts() {
  // Only run once per page load
  if (alertsProcessed) return;
  alertsProcessed = true;
  
  // Store alerts to show in order
  const alertsToShow = [];
  
  // Look for script tags with alert calls followed by window.location redirects
  document.querySelectorAll('script').forEach(script => {
    if (!script.textContent) return;
    
    // Find all alert calls in this script
    const alertRegex = /alert\(['"](.+?)['"]\);(?:\s*window\.location\s*=\s*['"](.+?)['"];)?/g;
    let match;
    
    // Use a counter to prevent infinite loops
    let matchCount = 0;
    const maxMatches = 10;
    
    // Find all matches in this script
    while ((match = alertRegex.exec(script.textContent)) !== null && matchCount < maxMatches) {
      matchCount++;
      
      const message = match[1];
      const redirect = match[2] || '';
      
      // Determine alert type based on message content
      let alertType = 'info';
      if (message.toLowerCase().includes('success') || 
          message.toLowerCase().includes('approved') || 
          message.toLowerCase().includes('deleted')) {
        alertType = 'success';
      } else if (message.toLowerCase().includes('error') || 
                message.toLowerCase().includes('failed') || 
                message.toLowerCase().includes('problem') || 
                message.toLowerCase().includes('technical')) {
        alertType = 'error';
      } else if (message.toLowerCase().includes('warning')) {
        alertType = 'warning';
      }
      
      // Add to our queue instead of showing immediately
      alertsToShow.push({
        message,
        type: alertType,
        redirect
      });
      
      // Replace the alert call with an empty function to prevent it from running
      script.textContent = script.textContent.replace(match[0], '/* Alert converted to SweetAlert */');
    }
  });
  
  // Show alerts one at a time
  if (alertsToShow.length > 0) {
    showNextAlert(alertsToShow, 0);
  }
}

// Function to show alerts sequentially
function showNextAlert(alerts, index) {
  if (index >= alerts.length) return;
  
  const alert = alerts[index];
  const showFunction = alert.type === 'success' ? showSuccessAlert :
                      alert.type === 'error' ? showErrorAlert :
                      alert.type === 'warning' ? showWarningAlert : showInfoAlert;
  
  showFunction(alert.message).then(() => {
    if (alert.redirect) {
      window.location = alert.redirect;
    } else {
      // Show next alert only if we're not redirecting
      showNextAlert(alerts, index + 1);
    }
  });
}

// Override the default JavaScript alert function
// This will catch any direct alert() calls and redirect them to SweetAlert
(function() {
  const originalAlert = window.alert;
  window.alert = function(message) {
    // Try to determine the alert type based on message content
    let alertType = 'info';
    if (typeof message === 'string') {
      const lowerMsg = message.toLowerCase();
      if (lowerMsg.includes('success') || 
          lowerMsg.includes('approved') || 
          lowerMsg.includes('deleted')) {
        alertType = 'success';
      } else if (lowerMsg.includes('error') || 
                lowerMsg.includes('failed') || 
                lowerMsg.includes('problem') || 
                lowerMsg.includes('technical')) {
        alertType = 'error';
      } else if (lowerMsg.includes('warning')) {
        alertType = 'warning';
      }
    }
    
    // Call the appropriate SweetAlert function
    return showSweetAlert(message, alertType);
  };
  
  // Run the conversion when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', convertPHPAlerts);
})();
