# SYSTEM ARCHITECTURE

## Methodology

### News Portal Web (Frontend)
- Register/Log in
- View news (list, detail, by category)
- Search news
- Like news
- View profile
- Dashboard
- Upload images (for content)

### Backend (Laravel API/Server)

#### Authentication & Authorization
- User registration
- User login/logout
- Role-based access control (Super Admin, Editor, Writer)
- Permission management
- Session management
- Online status tracking

#### News Management
- Create news (Writer)
- Read/view news (All users)
- Update/edit news (Writer, Super Admin)
- Delete news (Super Admin)
- Draft news (Writer)
- Update news status (Editor: Pending/Accept/Reject)
- Search news
- Filter by category
- Pin/unpin news
- View tracking (views counter)
- Image upload for news content

#### Category Management (Super Admin)
- Create categories
- Update categories
- Delete categories
- View category statistics

#### Banner Management (Super Admin)
- Create banners
- Read banners
- Update banners
- Delete banners
- Toggle banner status (active/inactive)
- Banner positioning (home page, detail page)

#### User Management (Super Admin)
- List all users
- Delete users
- Assign roles to users
- User profile management

#### Like System
- Like/unlike news articles
- Track likes per news

#### Notification System
- Send notifications (news created, status updated)
- Fetch notifications
- Mark notifications as read
- Unread notification count

#### File/Image Storage
- Store news images
- Serve images via storage route
- Image validation and security
