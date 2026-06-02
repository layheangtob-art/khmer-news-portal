# KH News Portal Project Presentation

## Chapter 1: Introduction

People in Cambodia rely on online platforms to read news daily and seek fast, easy access to hot and trending topics. However, existing news sources are often difficult to organize and access. To address these challenges, this project introduces a user-friendly news web application for Cambodian users, called **KH News Portal**. The system is designed to help users stay updated with the latest news at any time, offering a reliable, high-performance platform with features such as category browsing, keyword search, real-time likes, and Khmer Text-to-Speech for improved accessibility. Users can also connect with social platforms for further details and updates.

## Problem Statement

- People in Cambodia use online platforms to read news daily.
- Many users want fast and easy access to hot and trending news.
- Existing news sources can be difficult to organize and access.
- Most sites are not user-friendly or optimized for mobile and slow internet.
- Many sites have limited Khmer language and accessibility support.
- Readers sometimes waste time searching multiple sites.
- Users encounter outdated or duplicate information.
- Important updates are missed because there are no real-time notifications.
- Few portals support features like social sharing, comments, or Khmer text-to-speech.
- Social media integration is also limited.
- Therefore, there is a need for one easy-to-use website that:
  - organizes news in real time,
  - supports Khmer,
  - adds audio features,
  - and provides interactive options for Cambodian users.

## Chapter 2: Literature Review
Most current news portals in Cambodia face challenges with content management, accessibility for visually impaired users, and page load performance. Existing solutions often use heavy page reloads and lack integrated audio features. **KH News Portal** addresses these by using Hotwire Turbo for fast navigation and Google Cloud TTS to generate audio for articles, setting a new standard for local news platforms.

## Chapter 3: Method

**System Overview**

The system is a web-based news application for users in Cambodia.

It allows users to read the latest and trending news online.

The system has two main roles: User (Reader) and Admin (Reporter).

Users can browse, search, and read news articles easily.

Admin can manage news content (add, edit, delete) through a secure dashboard.

News is organized into categories such as sports, local news, technology, politics, and entertainment.

The system may include links from social media for more details and updates.

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

## Chapter 5: Key Findings

Simple and user-friendly UI designed for Cambodian users

Displays the latest and pinned news articles on the homepage

News categories include sports, local news, technology, and more

Allows readers to browse and search news by keywords or category

Users can like articles with real-time count updates without page reload

Khmer Text-to-Speech lets users listen to news articles for better accessibility

Dark mode support for comfortable reading in different lighting conditions

Dynamic sponsor banner carousel for rotating advertisements

Admin dashboard for managing news content, categories, banners, and users

Role-based access control for Super Admin, Editor, and Writer staff

## Chapter 6: Conclusion

During development, several problems were identified and addressed, such as database design, Google Cloud Text-to-Speech API integration, AJAX like-button functionality, and user interface responsiveness across mobile and desktop devices. These issues helped improve problem-solving skills and overall system development experience.

**Problem Solving**

Issues such as search errors in `NewsController.php`, image display problems in Blade templates, and configuring Spatie role-based permissions were resolved through iterative testing, debugging with Laravel Debugbar and Chrome DevTools, and Git-based version control.

**Limitations**

The project is still under development and not fully completed.

Advanced features such as public commenting, AI-based news recommendations, and detailed banner analytics are not yet implemented.

The system requires a smartphone or internet-connected device for access.

No native mobile application is available; the platform is web-only.

User experience may still need improvement based on real user testing and feedback.

**Future Goal**

Develop a complete and fully deployed website for real users on Hostinger with Cloudflare CDN.

Integrate AI features such as personalized content recommendations and automated article summarization.

Build a cross-platform mobile application using Flutter or React Native.

Improve system features based on user feedback, including public accounts, commenting, and social media sharing.

Enhance user experience and performance optimization for better usability.

## Chapter 7: Future Works
- **Mobile Application**: Developing a cross-platform mobile app using Flutter or React Native.
- **Search Optimization**: Implementing Meilisearch or Algolia for faster, more relevant searches.
- **Social Integration**: Deep integration with social media platforms for automated sharing.
- **Analytics Dashboard**: Detailed traffic and reader engagement analytics for administrators.
- **Newsletter System**: Automated email digests for subscribers.
