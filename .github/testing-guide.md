# Testing Guide - Playwright MCP Integration

## Overview

Playwright MCP server is configured for automated browser testing of both the PHP portfolio and Next.js v2.

## Quick Start

Once VS Code/Copilot is restarted, you can ask Copilot to perform browser automation tasks like:

- "Navigate to the admin login page and verify the form elements"
- "Test the project creation flow in the admin dashboard"
- "Check if the mobile menu works on the portfolio homepage"
- "Verify CV upload functionality"

## Test Scenarios for PHP Portfolio

### Admin Authentication
```
Test login at: http://localhost/admin/login.php
- Verify form has username and password fields
- Test login with credentials: admin/admin123
- Verify redirect to dashboard on success
- Test invalid credentials show error message
```

### CRUD Operations
```
Projects Module: http://localhost/admin/modules/projects/
1. Click "Nouveau projet" button
2. Fill form with test data
3. Upload test image
4. Save and verify redirect to list
5. Edit the created project
6. Verify changes persist
7. Delete and confirm removal
```

### File Uploads
```
CV Upload: http://localhost/admin/modules/cvs/
- Test PDF file upload (max 10MB)
- Verify MIME type validation
- Test main CV toggle functionality
```

### Responsive Testing
```
Test viewports:
- Mobile: 375x667 (iPhone)
- Tablet: 768x1024 (iPad)
- Desktop: 1920x1080

Focus areas:
- Sidebar collapse on mobile
- Table horizontal scroll
- Form layout adaptations
```

## Test Scenarios for Next.js v2

```
Development server: http://localhost:3000

Test areas:
- Homepage hero section animations
- Project cards hover effects
- Navigation menu functionality
- Contact form validation
- Page transitions with Framer Motion
```

## Common Playwright Actions

### Navigation
- Navigate to URL
- Click links/buttons
- Wait for page load
- Take screenshots

### Form Testing
- Fill input fields
- Select dropdowns
- Upload files
- Submit forms
- Validate error messages

### Assertions
- Check element visibility
- Verify text content
- Validate URLs
- Check CSS properties
- Confirm element count

### Responsive Design
- Set viewport size
- Test different devices
- Capture mobile/desktop screenshots

## Best Practices

1. **Use localhost URLs** - Ensure Laragon is running
2. **Start Next.js dev server** - For v2 testing: `cd v2-portfolio && npm run dev`
3. **Test data cleanup** - Delete test records after testing
4. **Screenshot failures** - Capture evidence when tests fail
5. **Test in order** - Authentication → CRUD → Complex flows

## Database State

Before testing CRUD operations, ensure:
- Database `portfolio` exists
- Schema imported from `database/admin_schema.sql`
- At least one admin user exists (default: admin/admin123)

## Troubleshooting

**"Cannot connect to localhost"**
- Verify Laragon/web server is running
- Check MySQL service is active
- Confirm correct port (default 80 for Apache)

**"Admin login fails"**
- Verify database connection in `.env`
- Check users table has active admin account
- Review `app/Auth.php` for session issues

**"File upload fails"**
- Check `uploads/` directory exists
- Verify write permissions (775)
- Confirm file size limits (10MB for CVs)

## MCP Configuration

Location: `%APPDATA%\Code\User\globalStorage\github.copilot-chat\mcpServers.json`

```json
{
  "mcpServers": {
    "playwright": {
      "command": "npx",
      "args": [
        "-y",
        "@executeautomation/playwright-mcp-server"
      ]
    }
  }
}
```

**Note**: Restart VS Code after MCP configuration changes.
