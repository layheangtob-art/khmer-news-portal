# KH News Portal Project Presentation

## Chapter 1: Introduction

People in Cambodia rely on online platforms to read news daily and seek fast, easy access to hot and trending topics. However, existing news sources are often difficult to organize and access. To address these challenges, this project introduces a user-friendly news web application for Cambodian users, called **KH News Portal**. The system is designed to help users stay updated with the latest news at any time, offering a reliable, high-performance platform with features such as category browsing, keyword search, real-time likes, and notifications for staff. Users can also connect with social platforms for further details and updates.

## Aim and Objectives

**Aim:** To design and develop a responsive Khmer news web platform for Cambodian readers and newsroom administrators.

**Objectives:**

- To create a web platform for displaying the newest and hot news in Cambodia.
- To provide organized news categories such as sports, entertainment, technology, and politics.
- To design a simple and responsive user interface for users.
- To allow users to access news easily anytime and anywhere.
- To implement keyword search and category browsing so readers can find articles quickly.
- To enable real-time interaction features such as article likes without page reload.
- To build a secure administrative dashboard for managing news, categories, users, and banners.
- To improve knowledge and skills in web development and database management.

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

The development outcomes were evaluated against the project objectives as follows:

- To create a web platform for displaying the newest and hot news in Cambodia — **achieved** through the public homepage with latest and trending articles.
- To provide organized news categories such as sports, entertainment, technology, and politics — **achieved** through category-based browsing and filtering.
- To design a simple and responsive user interface for users — **achieved** with a mobile-friendly layout using Bootstrap 5 and modern CSS.
- To allow users to access news easily anytime and anywhere — **achieved** through a web-based system accessible on phones, tablets, and desktops.
- To implement keyword search and category browsing — **achieved** with integrated search and category navigation.
- To enable real-time interaction features such as article likes — **achieved** with AJAX like updates without full page reload.
- To build a secure administrative dashboard — **achieved** with role-based access for Super Admin, Editor, and Writer staff.
- To improve knowledge and skills in web development and database management — **achieved** through Laravel, MySQL, and full-stack implementation practice.

## Chapter 6: Conclusion

During development, several problems were identified and addressed, such as database design, Google Cloud Text-to-Speech API integration, AJAX like-button functionality, and user interface responsiveness across mobile and desktop devices. These issues helped improve problem-solving skills and overall system development experience.

**Problem Solving**

Issues such as search errors in `NewsController.php`, image display problems in Blade templates, and configuring Spatie role-based permissions were resolved through iterative testing, debugging with Laravel Debugbar and Chrome DevTools, and Git-based version control.

**Limitations**


**Future Goals**

- To deploy a complete and fully functional website for real users on Hostinger with Cloudflare CDN.
- To integrate AI features such as personalized content recommendations and automated article summarization.
- To build a cross-platform mobile application using Flutter or React Native.
- To improve system features based on user feedback, including public accounts, commenting, and social media sharing.
- To enhance user experience and performance optimization for better usability.

## Chapter 7: Future Works
- **Mobile Application**: Developing a cross-platform mobile app using Flutter or React Native.
- **Search Optimization**: Implementing Meilisearch or Algolia for faster, more relevant searches.
- **Social Integration**: Deep integration with social media platforms for automated sharing.
- **Analytics Dashboard**: Detailed traffic and reader engagement analytics for administrators.
- **Newsletter System**: Automated email digests for subscribers.
