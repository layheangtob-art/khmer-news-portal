# SYSTEM ARCHITECTURE

## 3. System Development Methodology
This section outlines the technical approach and functional specifications implemented to build the news portal, structured across the frontend client layer and backend Laravel API server, with role-aligned feature sets to support all user workflows.

### 3.1 Frontend: Client-Side News Portal
The web-based frontend is designed to deliver an intuitive, responsive user experience for all platform users, with core features including:
- User authentication: Secure account registration and login/logout functionality to access personalized platform features
- Content consumption: Browse news articles in list view, access full-detail article pages, and filter content by predefined news categories
- Content interaction: Full-text search for news articles, like/unlike functionality to save and engage with preferred content
- User account tools: Personal profile management, role-specific user dashboards, and image upload capabilities for users creating news content

### 3.2 Backend: Laravel API Server
The backend layer is built on the Laravel PHP framework, providing secure, scalable server-side logic, data management, and API endpoints to support all frontend operations, organized into functional modules as follows:

#### 3.2.1 Authentication & Authorization Module
This module manages secure user access and role-based permissions to enforce least-privilege access to platform features:
- Core user authentication: Account registration, secure login/logout, and persistent session management for active users
- Role-based access control (RBAC): Three predefined user roles (Super Admin, Editor, Writer) with granular permission management
- User activity tracking: Real-time online status monitoring to track active platform users

#### 3.2.2 News Content Management Module
The core content module supports the full lifecycle of news article creation, review, and publication with role-aligned access:
- Article creation workflow: Writers can draft new articles, save in-progress work as unpublished drafts, and submit completed articles for editorial review
- Article access and editing: All users can view published articles; original writers and Super Admins can edit existing articles, while only Super Admins can delete published content
- Editorial review process: Editors can update article submission statuses (Pending/Accepted/Rejected) to manage content publication
- Content discovery tools: Full-text article search, category-based filtering, and pin/unpin functionality to feature high-priority articles on platform homepages
- Content analytics: Built-in view tracking to count article engagement, plus integrated image upload support to add media to news content

#### 3.2.3 Category Management Module (Super Admin Only)
Exclusive to Super Admin users, this module manages content classification for the entire platform:
- Full CRUD operations to create, update, and delete news categories
- Built-in category performance statistics to track engagement and content volume per classification

#### 3.2.4 Banner Management Module (Super Admin Only)
This module manages platform promotional and featured banners to highlight key content:
- Full CRUD operations for banner assets, plus functionality to toggle banner active/inactive status
- Positioning controls to assign banners to high-visibility platform locations, including the homepage and article detail pages

#### 3.2.5 User Management Module (Super Admin Only)
Super Admins can manage all platform user accounts and access permissions:
- View a complete list of all registered users, delete accounts as needed, and assign roles to new or existing users
- Support for user self-service profile management for all account types

#### 3.2.6 User Engagement Modules
These modules support user interaction and communication across the platform:
- Like system: Enables users to like/unlike news articles, with tracking to aggregate and display like counts per article
- Notification system: Automatically sends in-app notifications for key events (article creation, status updates), with functionality to fetch notifications, mark them as read, and display real-time unread notification counts

#### 3.2.7 Media Storage Module
This module handles secure storage and delivery of all user-uploaded media:
- Secure storage for news article images, with protected server-side routes to serve media assets
- Pre-upload image validation and security checks to prevent malicious file uploads and ensure compliance with platform media standards
