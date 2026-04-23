# KH News Portal Project Presentation

## Chapter 1: Introduction
**KH News Portal** is a modern, feature-rich web platform designed to deliver news and information to the Cambodian public efficiently. In an era where digital content consumption is rapidly increasing, this portal provides a seamless experience for both readers and content creators. The primary goal is to provide a reliable, high-performance news management system with unique accessibility features like Text-to-Speech (TTS).

## Chapter 2: Literature Review
Most current news portals in Cambodia face challenges with content management, accessibility for visually impaired users, and page load performance. Existing solutions often use heavy page reloads and lack integrated audio features. **KH News Portal** addresses these by using Hotwire Turbo for fast navigation and Google Cloud TTS to generate audio for articles, setting a new standard for local news platforms.

## Chapter 3: Method
The project is built on a robust and scalable architecture using:
- **Framework**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Bootstrap 5, jQuery, Hotwire Turbo (SPA-like experience)
- **Editor**: CKEditor 5 (Advanced content editing)
- **Database**: MySQL/SQLite
- **Access Control**: Spatie Laravel-Permission (Super Admin, Editor, Writer roles)
- **API Integration**: Google Cloud Text-to-Speech API
- **Deployment**: Laravel Herd / Local Server environment

## Chapter 4: Results
The development successfully achieved:
- **Efficient CRUD Operations**: Streamlined news and category management.
- **Role-Based Access**: Secure dashboard for different user levels.
- **Auto-Image Extraction**: Intelligent logic to use body images as featured images.
- **Audio Generation**: Automatic conversion of news text to Khmer speech.
- **Real-Time UI**: Instant image previews and notification systems.
- **Fast Navigation**: Turbo-powered transitions without full page reloads.

## Chapter 5: Discussion
The integration of Hotwire Turbo with traditional Laravel views provided a significant performance boost, though it required careful management of JavaScript initialization (as seen in the DataTables fixes). The automatic extraction of main images from body content improved the workflow for writers, reducing redundant uploads.

## Chapter 6: Conclusion
**KH News Portal** provides a comprehensive solution for news publishing in Cambodia. By combining a powerful backend with an accessible frontend and innovative features like TTS, the project demonstrates how modern web technologies can enhance the digital news experience.

## Chapter 7: Future Works
- **Mobile Application**: Developing a cross-platform mobile app using Flutter or React Native.
- **Search Optimization**: Implementing Meilisearch or Algolia for faster, more relevant searches.
- **Social Integration**: Deep integration with social media platforms for automated sharing.
- **Analytics Dashboard**: Detailed traffic and reader engagement analytics for administrators.
- **Newsletter System**: Automated email digests for subscribers.
