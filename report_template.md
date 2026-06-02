# Design and Development of an Interactive and Scalable Khmer News Portal Using the Laravel Framework

**មូលន័យសង្ខេប**
គម្រោងនេះផ្តោតលើការរចនា និងការអភិវឌ្ឍន៍ "Khmer News Portal" ដែលជាគេហទំព័រព័ត៌មានឌីជីថលមួយត្រូវបានបង្កើតឡើងដោយប្រើប្រាស់ Laravel framework។ គោលបំណងចម្បងគឺដើម្បីផ្តល់ព័ត៌មានទាន់ហេតុការណ៍ដល់ប្រជាជនកម្ពុជា ព្រមទាំងផ្តល់នូវមុខងារអន្តរកម្មដូចជាការ "Like" អត្ថបទ ការស្វែងរកព័ត៌មាន និងការបង្ហាញផ្ទាំងផ្សាយពាណិជ្ជកម្មដោយស្វ័យប្រវត្តិ។

**Abstract**
This report explains the design and development of the "Khmer News Portal." It is a news website built using the Laravel PHP framework. Today, many people in Cambodia read news online. Because of this, we need good news websites that are easy to use. This project creates a system where users can read news, like articles, and see sponsor banners. It also has a simple admin page to manage the news. The report shows the whole process, from planning to testing the system.

**Supervisor's research supervision statement**
This is to confirm that the project "Development of the Khmer News Portal" was made under my guidance. The student has finished all the required work for this report.

**Candidate's Statement**
I declare that this report and project are my own original work. It was built using Laravel and has not been used for any other degree.

**Acknowledgements**
I want to say a big thank you to my supervisor for their helpful advice. I also want to thank my family and friends for supporting me while I built this project.

---

## TABLE OF CONTENTS

| Section | Page |
| --- | --- |
| **មូលន័យសង្ខេប** | (3) |
| Abstract | (5) |
| Supervisor's research supervision statement | (6) |
| Candidate's Statement | (7) |
| Acknowledgements | (8) |
| Table of Contents | (9) |
|  |  |
| **CHAPTER 1 INTRODUCTION** | **(11)** |
| 1.1 Background to the Study | (11) |
| 1.2 Problem Statement | (11) |
| 1.3 Aim and Objectives of the Study | (12) |
| 1.4 Rationale of the Study | (13) |
| 1.5 Limitation and Scope | (13) |
| 1.6 Structure of Study | (14) |
|  |  |
| **CHAPTER 2 LITERATURE REVIEW** | **(15)** |
| 2.1 Overview of the Research Topic | (15) |
| 2.2 Key Theories and Model | (15) |
| 2.2.1 Overview of Theories | (15) |
| 2.2.2 Overview of Model | (16) |
| 2.3 Previous Studies and Findings | (16) |
| 2.3.1 Overview of existing applications | (16) |
| 2.4 Feature Review | (17) |
| 2.4.1 Existing Platform Features | (17) |
| 2.4.2 Existing Local News Portals (TVK & ThmeyThmey) | (17) |
| 2.4.3 Khmer News Portal Core Features | (18) |
| 2.4.4 Feature Comparison Table | (18) |
| 2.4.5 Summary of Feature Review | (18) |
| 2.5 Gap in Existing Research | (18) |
| 2.5.1 Unexplored Areas | (18) |
| 2.5.2 Inconsistencies in Findings | (19) |
| 2.5.3 Opportunities for Future Research | (19) |
|  |  |
| **CHAPTER 3 METHODOLOGY** | **(20)** |
| 3.1 Research Design | (20) |
| 3.1.1 Study Population | (20) |
| 3.2 Tools and Technologies Used | (20) |
| 3.3 Algorithm | (21) |
|  |  |
| **CHAPTER 4 SYSTEM ANALYSIS AND REQUIREMENTS** | **(25)** |
| 4.1 Requirements Analysis | (25) |
| 4.2 Functional and Non-Functional Requirements | (25) |
| 4.2.1 Functional Requirements | (25) |
| 4.2.2 Non-Functional Requirements | (27) |
| 4.3 Use Case Diagram | (27) |
| 4.4 System Architecture | (29) |
|  |  |
| **CHAPTER 5 SYSTEM DESIGN** | **(31)** |
| 5.1 Design Principles | (31) |
| 5.1.1 Modularity | (31) |
| 5.1.2 Scalability | (31) |
| 5.2 Database Design | (32) |
| 5.2.1 Schema Design | (32) |
| 5.2.2 Data Relationship | (34) |
| 5.3 Feature Architecture | (34) |
| 5.3.1 Schema Design | (35) |
| 5.3.2 Data Relationship | (35) |
| 5.3.3 Schema Design | (36) |
| 5.3.4 Data Relationship | (36) |
| 5.3.5 Summary | (38) |
|  |  |
| **CHAPTER 6 Implementations** | **(39)** |
| 6.1 Development Process | (39) |
| 6.2 Frameworks Implementations | (39) |
| 6.3 Testing and Debugging | (40) |
|  |  |
| **CHAPTER 7 ANALYSIS AND RESULTS** | **(41)** |
| 7.1 System Results and Performance | (41) |
| 7.2 Evaluation Against Objectives | (42) |
|  |  |
| **CHAPTER 8 DISCUSSION** | **(56)** |
| 8.1 Interpretation of Results | (56) |
| 8.2 Challenges and Limitation of Studies | (56) |
| 8.3 Comparison with Existing Systems | (57) |
|  |  |
| **CHAPTER 9 CONCLUSION** | **(58)** |
| 9.1 Summary | (58) |
| 9.2 Future Works | (58) |
| 9.3 Final Remarks | (63) |
|  |  |
| **REFERENCES** | **(64)** |
| **APPENDICES** | **(65)** |

---

# CHAPTER 1: INTRODUCTION

## 1.1 Background to the Study

In Cambodia, more people have smartphones and internet access today. Because of this, people change how they get their news. Instead of reading paper newspapers, they use the internet. The "Khmer News Portal" was created for these users. It gives them a simple and fast website to read news every day.

## 1.2 Problem Statement

In Cambodia, there are not many high-quality, local news websites for Khmer speakers. Many existing websites lack interactive features such as a "Like" button, so readers cannot engage easily with articles. Another common problem is poor mobile design; some sites do not display well or work smoothly on smartphones, even though most users in Cambodia browse on mobile devices. Finally, content and advertisement management is often difficult for administrators, who may struggle to organize news categories and sponsor banners in one simple system.

### 1.2.1 Proposed Solution

To address these problems, the **Khmer News Portal** was developed as a complete web solution. The system includes modern interactive features, including a real-time "Like" button that updates without reloading the page. The frontend uses a responsive layout so the site works well on phones, tablets, and desktop computers. For administrators, a dedicated dashboard makes it easy to manage news articles, categories, users, and multiple sponsor banners from one place.

## 1.3 Aim and Objectives of the Study

**Aim:** To design and develop a responsive, secure, and scalable Khmer News Portal using the Laravel framework.

**Objectives:**

1. To develop a secure backend with Laravel to manage news articles, categories, and user accounts.
2. To implement a real-time "Like" feature so readers can interact with articles without reloading the page.
3. To create a dynamic sponsor banner system that can display and rotate multiple advertisements on the website.
4. To design a clean and responsive public interface using HTML, CSS, JavaScript, and Laravel Blade templates.
5. To provide an administrative dashboard for creating, editing, and organizing news content and categories.
6. To implement a search function that allows readers to find news articles quickly by keywords.
7. To test and evaluate the system to ensure it meets functional and non-functional requirements.

## 1.4 Rationale of the Study

This project was created to deliver a better news experience for Cambodians. It allows readers to quickly find and engage with news, while giving admins powerful but easy tools to manage content and advertisements. The system fulfills real needs in both accessibility and management for online Khmer news.

## 1.5 Scope and Limitations

### Scope

This project includes the development of a Khmer news web application consisting of two main parts: the public news website and the administrative dashboard. The public website enables users to browse news articles by category, perform keyword searches, and interact with articles using a real-time "Like" feature. The administrative dashboard allows staff to manage (create, edit, delete) news articles, categories, users, and sponsor banners. All content management and configuration take place within this dashboard.

### Limitations

The system has the following limitations:

1. **Web Application Only:** It is only accessible via a website and does not offer native mobile apps for iOS or Android devices.
2. **No Public User Registration:** Regular users cannot create accounts or log in; only admin staff have access to protected areas.
3. **No Article Commenting:** Visitors cannot comment on news articles; comment functionality is not included in this version.
4. **Single Language Support:** The platform currently supports only the Khmer language; there is no multi-language or translation feature.
5. **Basic Analytics:** There are no advanced analytics, such as real-time user statistics or detailed banner click tracking, provided to administrators.
6. **No Email Notifications:** The system does not send notification emails for new posts, comments, or system updates.
7. **No Social Media Integration:** There are no features for sharing articles directly to social media platforms from the website.
8. **Admin-Only Content Management:** Only authorized staff can add, edit, or delete news articles, categories, and banners. Public users have no content contribution abilities.

### Key Features:

- Responsive public news website for reading articles by category and keyword search
- Real-time "Like" feature for articles with instant count updates
- Dynamic sponsor banner system supporting multiple rotating advertisements
- Clean and modern user interface using Laravel Blade, HTML, CSS, and JavaScript
- Administrative dashboard for managing news, categories, users, and banners
- Secure, role-based admin access for content management
- Integrated search functionality for fast retrieval of articles


Future updates may address these limitations to improve the system for both readers and administrators.

## 1.6 Structure of Study

The report is structured into clearly defined sections to systematically detail the process of developing the Khmer News Portal. The intermediate breakdown is as follows:

1. **Front Matter**
   - Title page, acknowledgement, abstract, and table of contents to introduce the report’s purpose and provide navigation.

2. **Chapter 1: Introduction**
   - Outlines the study context, states the main problem, sets out the aim, lists specific project objectives, defines the rationale, and describes the scope and limitations.

3. **Chapter 2: Literature Review**
   - Analyzes academic research, studies related theories and frameworks (e.g., MVC, Agile), and reviews similar systems and past projects. Highlights technology changes in news portals.

4. **Chapter 3: Methodology**
   - Describes the adopted approach, details requirements gathering, explains project planning stages, tool selection, and introduces the iterative/agile development model.

5. **Chapter 4: System Analysis and Requirements**
   - Details system requirements, both functional and non-functional, presents use case diagrams, system workflows, stakeholder roles, and explores security requirements.

6. **Chapter 5: Database and Feature Design**
   - Illustrates the structure of the database (including ER diagrams), explains entity relationships, describes data models, and documents the design of major features like the like function and banner system.

7. **Chapter 6: Implementation**
   - Gives a step-by-step account of the development phase using Laravel, explains backend and frontend integration, and covers how the real-time like and banner rotation features were built.

8. **Chapter 7: Testing and Results**
   - Summarizes testing strategies (unit, integration, and user acceptance tests), presents system validation, and analyzes usability and performance test outcomes.

9. **Chapter 8: Discussion**
   - Interprets the outcomes, discusses technical and user challenges encountered, and analyzes how project objectives were met or where gaps remain.

10. **Chapter 9: Conclusion and Recommendations**
    - Draws final conclusions, evaluates how well the portal met user and technical needs, and offers suggestions for further development (e.g., mobile app extension, advanced analytics, multi-language support).

11. **References**
    - Lists scholarly studies, frameworks, tools, and external resources referenced throughout the project.

12. **Appendices**
    - Includes supplementary materials such as interface screenshots, important code snippets, and sample admin/user documentation.

This intermediate structure shows the progression from background research to requirements specification, system implementation, evaluation, and forward-looking recommendations, allowing readers to follow the entire development journey of the Khmer News Portal step by step.

---

# CHAPTER 2: LITERATURE REVIEW

## 2.1 Overview of the Research Topic

This project presents the development of the Khmer News Portal, a modern and efficient online news platform tailored for Cambodian users. The aim is to deliver a fast, interactive, and user-friendly experience that addresses common shortcomings found in other local news sites, such as poor performance and limited feature sets. The portal is built using a robust technology stack including Laravel (PHP MVC framework) for the backend, Blade for templating along with HTML, CSS, and JavaScript for dynamic frontend interaction, and MySQL for database management. The system also utilizes Laravel’s authentication, AJAX for real-time updates like live article likes, and implements dynamic sponsor banner sliders. Together, these technologies create a highly maintainable, secure, and responsive website that not only improves the user experience but also streamlines administrative tasks, demonstrating the effectiveness of custom solutions for the Cambodian news media landscape.



## 2.2 Key Theories and Model

### 2.2.1 Overview of Theories

This section explains the main theories and models that provide a deeper understanding of the Khmer News Portal project. These theories help explain why users interact with online news, how they adopt new technology, and how the portal’s design helps users efficiently find information.

Here are the key theories and models applied to this project:

1. **Uses and Gratifications Theory**
   - Focuses on why people use media platforms, such as news websites, and what benefits they seek.
   - In the context of the Khmer News Portal, users visit the portal to fulfill needs such as staying informed, entertainment, forming opinions, and social interaction (for example, reading trending news or liking articles).
   - The portal is designed to satisfy these needs by providing up-to-date news, multimedia content, interactive features (like the Like button), and easy navigation.

2. **Technology Acceptance Model (TAM)**
   - Explains how users come to accept and use new technology, especially focusing on perceived usefulness and perceived ease of use.
   - The Khmer News Portal leverages this model by making sure the site is easy to use (clear menus, fast load times, mobile-friendly) and directly beneficial (instant updates, real-time features such as live likes).
   - Administrative features are streamlined so both readers and staff members find the system accessible and effective.

3. **Information Foraging Theory**
   - Suggests that users search for information online in a way similar to animals foraging for food—they try to find the most valuable information with the least effort.
   - The portal’s design uses this theory by structuring content clearly, providing fast integrated search, and using visual cues (like highlighted headlines and banners) so that users can quickly locate news of interest.
   - This helps readers prioritize their attention and minimizes the time spent searching for relevant topics.

4. **Model-View-Controller (MVC) Architecture**
   - Separates the application’s structure into models (data), views (UI), and controllers (logic), making the site easier to develop, maintain, and scale.
   - This separation helps add new features or fix issues without disrupting the rest of the system, ensuring a consistent and reliable user experience.

5. **Agile Development Model**
   - Promotes building software in cycles, with continuous feedback, fast iterations, and adaptability.
   - Allows the portal to introduce core features (like banner sliders) first and then upgrade functionality (such as live like counts and improved search) with each new release based on user needs.

These theories collectively guided the project to deliver a news portal that is user-centered, rapidly adopted, engaging, and effective for readers and administrators alike.

This project uses the **MVC Architecture**. This means the code is split into three parts: Model (for data), View (for the design), and Controller (for the logic). This makes the code clean and easy to fix.

### 2.2.2 The Model Component (MVC)

In the Khmer News Portal project, the **Model** refers to the part of the system that handles the data and business logic. Models are responsible for interacting with the database—such as retrieving news articles, saving new posts, tracking user likes, managing categories, and handling banners. In Laravel, Models are PHP classes that represent different data types, and each Model usually matches a table in the database (for example, there are models for News, User, Category, and Banner).

When a user reads news or clicks "Like," the Model updates the correct data in the database. This separation ensures that business rules and data management are clearly organized, making the project easier to maintain, test, and upgrade later. Using the Model as part of the MVC pattern helps keep the codebase clean, organized, and secure, allowing for efficient handling of all the information behind the Khmer News Portal.

The project used the **Agile Development Model**. This means we built the website step-by-step. We added features slowly, like adding the banner slider first, and then adding the like button later.

## 2.3 Previous Studies and Findings

### 2.3.1 Overview of Existing Applications in Cambodia

This section looks at news websites and content management systems that are popular in Cambodia. Many Cambodian news websites are built using platforms like WordPress or Joomla because these tools are easy to use and set up quickly. However, these standard platforms often come with extra features that are not needed, which can make the websites slower and harder to customize for local needs.

A lot of Cambodian news portals using these platforms experience slow loading times, basic search features, and limited interactive elements for readers. The designs are often generic, making it harder for them to stand out or provide a unique experience. Also, changing or adding features specific to Cambodian newsrooms—like Khmer language support or custom banner placements—can be difficult with ready-made solutions.

Building a custom solution like the Khmer News Portal with Laravel directly addresses these issues. It allows for better speed, easier customization, more security, and the ability to include features designed especially for Cambodian readers and administrators. As a result, custom-built sites can better serve the needs of the local audience compared to generic CMS platforms.

Many local news websites use tools like WordPress. WordPress is good, but it can be slow and have too many things you don't need. Building a custom website with Laravel makes it faster and gives us exactly the features we want.

## 2.4 Feature Review
The Khmer News Portal is designed to serve the needs of local readers and content administrators in Cambodia, with features that address the gaps found in traditional news platforms. To understand the relevance and competitiveness of the proposed portal, this section reviews the features of existing Cambodian news websites and compares them to the Khmer News Portal in terms of user engagement, system performance, content management, and advertisement flexibility.




### 2.4.1 Existing Platform Features

Currently, major general news platforms and mainstream Content Management Systems (CMS) including WordPress, Drupal, and Joomla serve as the backbone of most local Cambodian news websites. Their core out-of-the-box features typically include:
﻿﻿Basic article publishing and text editing tools
﻿﻿Category and tag organization for content
﻿﻿Image and media upload functionality
﻿﻿Basic user permission settings for administrators
WordPress, which powers the majority of local news sites, offers limited native advertising capabilities out of the box, requiring additional plugins to manage multiple sponsorships. Drupal and Joomla, while more customizable, have steep learning curves that make them difficult for small local news teams to manage. Furthermore, reader interaction features are often restricted to third-party commenting plugins or simple social media share buttons, with very few local platforms investing in native, real-time interactive features like live like counts that update without page reloads.

### 2.4.2 Existing Local News Portals (TVK & ThmeyThmey)

To understand the landscape of digital news in Cambodia, we analyzed two prominent local platforms: **TVK News** ([tvk.gov.kh](https://www.tvk.gov.kh/)) and **ThmeyThmey** ([thmeythmey.com](https://www.thmeythmey.com/)).

#### TVK News Website
The TVK official news website is a government-run portal primarily focused on official updates.
- **WordPress-Based**: Relies on a standard WordPress infrastructure which, while reliable, can suffer from performance bottlenecks due to plugin dependency.
- **Traditional Layout**: Uses standard category archives and hierarchical menus for navigation.
- **Restricted Interaction**: Public commenting is typically disabled on most official articles to maintain content integrity, and it lacks real-time interactive features like dynamic "Like" counts.

#### ThmeyThmey News Website
ThmeyThmey is one of Cambodia's most popular private news portals known for its wide coverage.
- **Customized CMS**: Uses a highly customized content management system designed for high-traffic news delivery.
- **Social Engagement**: Includes public commenting systems (often via Facebook integration) to encourage reader discussion.
- **Limited Real-time Performance**: While feature-rich, it primarily uses traditional page-load patterns for navigation. Native accessibility features like Text-to-Speech (TTS) are not integrated into the core platform experience.

### 2.4.3 Khmer News Portal Core Features
To highlight the purpose-built capabilities of our project, the Khmer News Portal includes the following core native features organized by user type:

#### Public Reader Features
- **Responsive multi-device layout** that adapts to mobile phones, tablets, and desktop screens.
- **Dark Mode Support**: Native toggle for light and dark themes to improve readability in different lighting conditions.
- **Audio News (TTS)**: Integrated Google Cloud Text-to-Speech to convert Khmer news articles into audio for better accessibility.
- **Fast Navigation**: Powered by Hotwire Turbo to provide a smooth, SPA-like experience without full page reloads.
- **Real-time article "Like" functionality** that updates counts dynamically via AJAX.
- **Integrated on-page keyword search** with instant results loading.
- **Automatic rotating sponsor banner carousel** that showcases multiple active advertisements.

#### Administrator Features
- **Secure Role-Based Access Control (RBAC)**: Different levels of access for Super Admins, Editors, and Writers using Spatie's permission system.
- **Advanced Content Editing**: Integrated CKEditor 5 for professional article formatting and media management.
- **Automated Image Handling**: Intelligent logic to extract and process images from article bodies.
- **Full Dashboard Analytics**: Centralized interface to manage news, categories, banners, and user accounts.
- **Real-time Notifications**: System alerts for content approvals and user activities.


### 2.4.4 Feature Comparison Table

The following table summarizes the key feature differences between standard CMS platforms, the TVK and ThmeyThmey news websites, and the proposed Khmer News Portal:

| Feature | Standard CMS | TVK News | ThmeyThmey | **Khmer News Portal** |
| :--- | :---: | :---: | :---: | :---: |
| **Laravel 11 (MVC)** | ❌ | ❌ | ❌ | ✅ |
| **Hotwire Turbo (Fast)** | ❌ | ❌ | ❌ | ✅ |
| **Built-in AJAX Likes** | ❌ | ❌ | ❌ | ✅ |
| **Dynamic Ad Slider** | ❌ | ❌ | ❌ | ✅ |
| **Fast Integrated Search**| ❌ | ❌ | ❌ | ✅ |
| **Khmer Text-to-Speech** | ❌ | ❌ | ❌ | ✅ |
| **Native Dark Mode** | ❌ | ❌ | ❌ | ✅ |
| **Laravel Security** | ❌ | ❌ | ❌ | ✅ |
| **Role-Based (RBAC)** | ❌ | ❌ | ❌ | ✅ |
| **Secure Authentication**| ✅ | ✅ | ✅ | ✅ |
| **Public Commenting** | ✅ | ❌ | ✅ | ❌ |

### 2.4.5 Summary of Feature Review

From this review, it is evident that while the Khmer News Portal draws inspiration from established platforms like TVK and ThmeyThmey, it distinguishes itself through a highly interactive, high-performance, and accessibility-focused experience. The use of Hotwire Turbo for fast navigation, real-time AJAX interactions, and integrated Khmer Text-to-Speech demonstrates a focus on technical sophistication and user inclusivity, which is not fully realized in many traditional or standard CMS-based news portals in Cambodia.

## 2.5 Gap in Existing Research

### 2.5.1 Unexplored Areas
Existing academic studies mostly focus on generic CMS platforms like WordPress and Drupal that are widely used for Cambodian news websites, but there is limited research on building custom, purpose-built news portals using modern PHP frameworks like Laravel. Scholarly works rarely address the specific technical challenges of deploying high-performance, interactive news platforms for local Cambodian audiences, particularly around optimizing media delivery for low-bandwidth internet connections and integrating native real-time features like live like counts without relying on heavy third-party plugins.

There is not much information on how to make a custom Laravel news website fast for internet users in Cambodia, especially when loading big images.

### 2.5.2 Inconsistencies in Existing Research
Existing research claims that heavy JavaScript frameworks (e.g., React) are required to build interactive web features. This project contradicts that finding: lightweight vanilla JavaScript paired with Laravel successfully delivers real-time features like the dynamic Like button, proving that complex frontend frameworks are not mandatory for high-performing interactive news portals in Cambodia.

Some people think you must use heavy JavaScript tools (like React) to make a website interactive. But, we found that simple JavaScript with Laravel works very well for things like the Like button.

### 2.5.3 Opportunities for Future Research

In the future, researchers and developers could explore the integration of artificial intelligence to deliver personalized news recommendations tailored to individual user reading preferences, creating a more engaging and customized experience for audiences. Additional areas of potential study include the development of native mobile applications for iOS and Android to extend the portal’s reach beyond web-only access, and the implementation of multi-language support to serve diverse linguistic communities across Cambodia. Further research could also investigate advanced analytics solutions that provide administrators with real-time user engagement metrics, detailed sponsor banner click-through rates, and audience demographic insights to support data-driven content and advertising decisions. Exploring the addition of social media sharing integrations and public commenting systems with robust moderation tools could also be valuable to enhance reader interaction, while assessing the scalability of the current Laravel-based architecture to support growing user bases and increasing content volumes would help guide long-term platform improvements.

In the future, people could study how to use AI to recommend news to users based on what they like to read.

---

# CHAPTER 3: METHODOLOGY

## 3.1 Research Design

The methodology of this study follows a design and implementation-based approach, focusing on building a full-stack web application using modern technologies like the Laravel framework.
The development process is divided into key phases: requirement analysis, system design, implementation, and testing. This applied research emphasizes practical development, evaluating the system's performance and usability based on intended functionalities for both local readers and administrative staff.
A qualitative and developmental research design is adopted, where the platform is iteratively developed, tested, and refined based on feedback. The goal is to produce a functional digital news portal with features like dynamic sponsor banners, real-time user interaction, secure content management, and integrated search.
Agile development methodology was followed to manage the timeline. This approach allowed incremental progress, continuous integration, and flexibility in implementing changes—such as replacing an initial search pop-up with a more efficient search bar—based on testing and feedback.

### 3.1.1 Study Population
The target study population for this Khmer News Portal project consists of two core stakeholder groups that form the primary users of the system:
1. **Public End Users**: Cambodian internet users of all age demographics who access daily local news via web and mobile devices. This group includes casual readers, researchers, and regular news consumers who rely on digital platforms to stay updated on local, national, and international events. The population is specifically tailored to users within Cambodia’s digital landscape, accounting for common local infrastructure constraints such as variable internet speeds and high mobile device usage rates.
2. **Administrative Users**: The internal newsroom and technical staff responsible for managing the portal’s content. This group includes editors, content writers, and system administrators who create, publish, and moderate news articles, manage sponsor banners, organize content categories, and maintain platform user accounts. Their needs informed the design of the admin dashboard’s workflow, accessibility, and role-based access controls.

This website is made for internet users in Cambodia who want to read daily news. It is also for the admin team who will manage the website.

This website is made for internet users in Cambodia who want to read daily news. It is also for the admin team who will manage the website.

## 3.2 Tools and Technologies Used
The Khmer News Portal was developed using the Laravel stack, optimized for high-performance, secure web development suited to the Cambodian digital landscape. The key tools and technologies used include:

Frontend (Client-side):

Blade Templating Engine – Laravel’s native templating system for creating reusable, consistent UI components across all site pages.
HTML5/CSS3 – For building semantic, accessible page structure and base styling.
Bootstrap 5 – For responsive layouts that adapt seamlessly to mobile, tablet, and desktop devices.
Vanilla JavaScript – To power core interactive features like real-time article likes and dynamic banner carousels, avoiding the overhead of heavy frontend frameworks.
AJAX – For handling asynchronous server requests to update like counts and search results without full page reloads.

Backend (Server-side):

PHP 8.2 – Modern PHP runtime for building secure, scalable backend services that align with Laravel 11’s requirements.
Laravel 11 – PHP framework that natively supports the MVC architectural pattern, with built-in authentication, routing, and input validation to accelerate development.
Laravel Herd – Streamlined local development environment optimized for Laravel projects to simplify local testing and configuration.
Spatie Permissions – Package for implementing role-based access control (RBAC) for admin user accounts.
CKEditor 5 – Integrated rich text editor for administrators to create and format news articles.
Google Cloud Text-to-Speech API – To power native Khmer audio news functionality for improved accessibility.

Database:

MySQL – Open-source relational database to store all application data including user accounts, news articles, categories, banners, and user interaction records.

Deployment & Version Control:
Hostinger – Managed web hosting platform used to deploy the production Laravel application, preconfigured with PHP 8.2, MySQL, and SSL to meet runtime needs. Its native deployment tools and automated backups simplified launching and securing the project.
Cloudflare – A CDN and security service that boosted site speed for local users by caching static assets (images, CSS, JS) at nearby edge locations to work better on slow Cambodian internet connections. It also added critical protections including DDoS mitigation, SSL encryption, and built-in traffic analytics to monitor performance and block external threats.
Termius – SSH client that streamlined secure remote server management for the Hostinger production environment, enabling reliable server configuration, dependency updates, maintenance, file transfers, and production issue troubleshooting throughout deployment and post-launch.
Git & GitHub – For version control, incremental feature tracking, and reliable rollbacks to support the project’s iterative Agile methodology.

Git & GitHub – For version control, incremental feature tracking, and reliable rollbacks to support the project’s iterative Agile methodology.

Testing & Debugging:

Laravel’s Built-in Testing Tools – For running unit and integration tests to validate system functionality.
Chrome DevTools – For frontend debugging of interactive features like the like button and banner carousel.
Laravel Debugbar – For backend performance monitoring and error tracking during development.

## 3.3 Algorithm
The algorithm used in the Khmer News Portal outlines the core process of managing content and enabling user interaction with the platform. The following step-by-step process describes the primary flow of user interactions, focusing on the system’s key features including banner rotation and real-time article likes:

### Dynamic Banner Rotation (step-by-step workflow)
1. Step 1: On initial website load, the backend queries the database to retrieve all stored banner records.
2. Step 2: The system filters the full list to retain only banners marked "active", excluding unpublished, expired, or archived sponsor ads.
3. Step 3: Active banners are sorted by their scheduled display start date, then passed from the server-side controller to the frontend page template.
4. Step 4: The client-side Bootstrap carousel initializes, rendering all active banners into the rotating slider interface.
5. Step 5: The carousel automatically transitions to a new banner every 5 seconds, and incrementally logs each banner impression to the database for performance reporting.

### Real-time Article Like Button (step-by-step workflow)
1. Step 1: A user clicks the "Like" button beneath a news article, triggering the page's embedded like-handling JavaScript.
2. Step 2: The JavaScript sends an asynchronous AJAX request to the backend, including the target article's ID and a CSRF security token to validate the request.
3. Step 3: The server checks the user's browser session for an existing unique device ID; if none is found, it generates and stores a new unique ID for that device.
4. Step 4: The system queries the `likes` database table to check if the current device ID has already submitted a like for the target article.
5. Step 5: If a prior like exists, the record is deleted (toggling the like off, or "unliking" the article); if no record exists, a new like entry is created for the device-article pair.
6. Step 6: The backend returns a JSON response to the browser, containing the updated total like count for the article and a flag indicating if the user currently has the article liked.
7. Step 7: The JavaScript updates the like count display on the page immediately, without requiring a full page reload, so the user sees the updated count instantly.

This section outlines the core tools and technologies that underpinned the development of the Khmer News Portal, organized by backend and frontend systems to align with the project’s goals of performance, maintainability, and scalability for the Cambodian digital landscape.

### Backend Technologies
- **Laravel 11**: A modern PHP framework that natively supports the Model-View-Controller (MVC) architectural pattern, enabling clean separation of data, business logic, and user interface layers. Laravel’s built-in secure routing system, authentication controls, and input validation features were critical to meeting the project’s security requirements, reducing the need for custom-built infrastructure and accelerating development timelines.
- **MySQL**: An open-source relational database system used to store and manage all application data, including user accounts, news articles, content categories, sponsor banners, and user interaction records like article likes. It was selected for its reliability, scalability, and native integration with the Laravel ecosystem.
- **Laravel Herd**: A streamlined local web server environment optimized for Laravel projects that simplified environment configuration and local testing throughout the development lifecycle.
- **Git**: A version control system that enabled incremental tracking of code changes, collaborative development, and reliable rollbacks of features that required refinement, supporting the iterative Agile methodology adopted for the project.

### Frontend Technologies
- **Blade Templating Engine**: Laravel’s native templating engine, implemented to standardize and reuse common page components (such as site headers, footers, and navigation menus) across all public and administrative interfaces, eliminating code redundancy and simplifying long-term maintenance.
- **HTML5**: Used to create semantic, accessible page structure for all site interfaces.
- **CSS3 + Bootstrap 5**: The Bootstrap 5 CSS framework was leveraged to build responsive layouts that adapt seamlessly to mobile, tablet, and desktop devices.
- **Vanilla JavaScript**: Used to power core interactive features including the real-time article Like button and dynamic banner carousel, avoiding the overhead of heavy frontend frameworks.

## 3.3 Algorithms and Main Process Flow

This section explains the core processes and main flow of the Khmer News Portal project. It describes how content is managed and how users interact with key features, such as dynamic banner display and the real-time Like button.

### Main Steps in the System

1. **User visits the news portal:** The system loads the latest news articles and active sponsor banners from the database.
2. **Banner Display Algorithm:** When the home page loads, only banners marked as "active" in the database are selected and shown in a rotating slider (carousel).
3. **News Article Display:** Articles are fetched according to their categories and shown to readers, with search and filter options.
4. **Like Button Algorithm:** When a user clicks the Like button,
    - JavaScript sends an AJAX request to the backend containing the article ID.
    - The backend checks if the user's browser/device has already liked the article.
    - If yes, the like is removed (unliked). If not, the like is added.
    - The updated like count is returned instantly and displayed without a page reload.
5. **Admin Actions:** Administrators can log in, create/edit/delete articles, manage categories, and upload or enable/disable banners.

### Project Process Flowchart

Below is a simplified flowchart representing the main workflow of the Khmer News Portal project:

```mermaid
flowchart TD
    A[Start: User visits website] --> B{Is user admin?}
    B -- No --> C[Show news & banners]
    C --> D[User interacts (search, read, like)]
    D --> E{Click Like?}
    E -- Yes --> F[Send AJAX to backend]
    F --> G{Previously liked?}
    G -- Yes --> H[Unlike article; update count]
    G -- No --> I[Like article; update count]
    E -- No --> J[Continue browsing]
    H --> J
    I --> J
    J --> K[End session or continue]
    B -- Yes --> L[Admin dashboard]
    L --> M[Add/edit news, banners, categories]
    M --> J
```

This flow describes both the public user experience (reading news, using likes, searching) and the administrator’s management tasks. It highlights how the core algorithms handle banner rotation and real-time likes for articles within the portal.

The website uses simple algorithms to get data. For the banners, the system looks into the database, finds all active banners, and puts them into a slider. For the "Like" button, the system uses JavaScript to send a background message to the database to add +1 to the likes, without reloading the page.

---

# CHAPTER 4: SYSTEM ANALYSIS AND REQUIREMENTS

## 4.1 Requirements Analysis

Before the development of the Khmer News Portal, a comprehensive requirement analysis was conducted to determine what functionalities were essential to the target users (public readers, editors, writers, and system administrators). The platform aims to provide a fast and seamless news reading experience for Cambodian audiences, combined with a simple and secure content management system for newsroom staff. The analysis focused on understanding user needs in terms of:

- News content creation and management
- User authentication and role-based access control
- News discoverability through categories and search
- User engagement through real-time likes and sponsor banners
- Performance, security, and responsiveness across devices

The requirements gathered through competitor analysis of existing Cambodian news portals (such as TVK and ThmeyThmey), review of the problem statement in Chapter 1, and evaluation of the project objectives were categorized into functional and non-functional requirements to guide the development process.

## 4.2 Functional and Non-Functional Requirements

### 4.2.1 Functional Requirements

The functional requirements define specific behaviours and features that the Khmer News Portal must support:

**User Authentication:**

- User registration and login/logout for staff members
- Session-based authentication managed through Laravel
- Role-based access control with three roles: Super Admin, Editor, and Writer

**News Article Management:**

- Create, edit, and delete news articles
- Save drafts and submit articles for editorial review
- Assign articles to predefined categories
- Pin featured articles on the homepage

**News Editor:**

- Rich-text editing using CKEditor 5
- Support for media content (images, links, headers, and formatted text)

**User Profile:**

- View and edit personal information (name, profile image)

**Dashboard:**

- Display dashboard overview for authenticated staff
- Manage all news articles (drafts and published)
- View article analytics (views and likes)

**Search Functionality:**

- Search news articles by title or content
- Browse news by category

**Interaction System:**

- Like and unlike news articles
- Real-time like count updates via AJAX without page reload

**Notifications:**

- Receive notifications for new article submissions and status updates
- Differentiate between read and unread notifications

**Category Management (Super Admin):**

- Create, update, and delete news categories
- View category statistics and article counts

**Banner Management (Super Admin):**

- Upload and manage sponsor banner images
- Toggle banner active/inactive status
- Display active banners in a rotating carousel on the public site

**User Management (Super Admin):**

- View all registered staff accounts
- Assign roles and delete user accounts

**Public Reader Features:**

- Browse homepage with latest and pinned news
- Read full article details with images and metadata
- Switch between light and dark display modes
- Listen to Khmer news articles using Text-to-Speech (TTS)

### 4.2.2 Non-Functional Requirements

The non-functional requirements define the quality standards the Khmer News Portal must meet:

**Performance:**

- Fast page loading optimized for users on mobile networks in Cambodia
- AJAX-based interactions for likes and search without full page reload
- Hotwire Turbo for smooth, SPA-like navigation across the site
- Efficient database queries with shared banner loading across pages

**Usability and Accessibility:**

- Responsive layout that works on mobile phones, tablets, and desktop computers
- Consistent header, footer, and navigation across all pages
- Correct display of Khmer script across all screen sizes
- Dark mode and Text-to-Speech support for improved readability and accessibility

**Security:**

- Password hashing and secure session management through Laravel authentication
- Role and permission enforcement on all protected admin routes
- Server-side input validation for all forms and user submissions
- CSRF protection on all state-changing requests
- Safe file upload validation for images and media content

**Reliability and Scalability:**

- MVC architecture for clear separation of logic, data, and presentation
- Database design that supports growing volumes of news, categories, and users
- Graceful error handling for invalid requests and unauthorized access
- Code organized following Laravel conventions for long-term maintainability

**Compatibility:**

- Support for modern web browsers (Chrome, Safari, Firefox) on mobile and desktop
- Deployment on PHP 8.x with MySQL and Laravel 11 framework

## 4.3 Use Case Diagram

**Actors:**

Guest User (Public Reader): Can view news articles, search content, browse by category, like articles, view sponsor banners, and use dark mode or Text-to-Speech.

Registered User (Staff): Has access to create, edit, review, and manage news content based on assigned role (Writer, Editor, or Super Admin).

System: Handles authentication, notifications, banner rotation, and background processes.

**Use Cases:**

Authenticate User

- Register new staff account
- Login and logout with session management
- Enforce role-based access control (Super Admin, Editor, Writer)

Manage News Articles

- Create, edit, or delete news articles
- Save as draft or submit for editorial review
- Assign articles to categories and pin featured articles

Use News Editor

- Write content using CKEditor 5
- Upload images and embed links

Review News Content

- View submitted articles pending approval
- Accept or reject article publication status

Manage Categories

- Create, update, or delete news categories
- View category statistics and article counts

Manage Banners

- Upload and manage sponsor banner images
- Toggle banner active/inactive status

Manage User Accounts

- View all registered staff users
- Assign roles and delete user accounts

Manage User Profile

- View and update profile information
- Update profile image

Interact with Content

- Like and unlike news articles
- Listen to articles using Text-to-Speech (TTS)

Search and Browse

- Search news by keywords
- Browse news by category

Receive Notifications

- Get notified about new article submissions and status updates
- Mark notifications as read or unread

View Dashboard

- Access admin dashboard overview
- Manage drafts and published articles
- View article analytics (views and likes)

## 4.4 System Architecture

The Khmer News Portal follows a client-server architecture using the Laravel stack with the MVC (Model-View-Controller) pattern. The system components include:

**Frontend (Blade + Bootstrap 5):**

- User interface for news reading, content management, and account management
- Handles responsive layout, dark mode, and dynamic banner carousel
- Powers real-time interactions such as article likes and search using AJAX and Vanilla JavaScript

**Backend (Laravel 11 + PHP 8.2):**

- Handles routes for authentication, news management, categories, banners, and user interactions
- Communicates with MySQL for data operations through Eloquent models
- Enforces role-based access control using Spatie Permissions

**Database (MySQL):**

- Stores structured tables: Users, News, Categories, Banners, Likes, and Notifications

**Authentication (Laravel Session + RBAC):**

- Secure login, registration, and logout with session management
- Role-based access control for Super Admin, Editor, and Writer roles

**Deployment:**

- Backend and database deployed on Hostinger
- Cloudflare used for CDN caching, SSL, and performance optimization
- Local development environment managed through Laravel Herd

This architecture ensures a robust, scalable, and responsive experience, allowing real-time interactions and smooth content management for both public readers and newsroom staff.

---

# CHAPTER 5: SYSTEM DESIGN

## 5.1 Design Principles

The design of the Khmer News Portal is guided by two key principles: modularity and scalability, which ensure the system is both manageable and extendable over time.

### 5.1.1 Modularity

The Khmer News Portal is developed with a modular architecture using the Laravel stack (PHP, Laravel 11, MySQL, Blade, and JavaScript). Each core feature—authentication, news management, category management, banner management, notifications, and user interactions—is implemented as a self-contained module. This modular approach enhances:

- **Code readability:** Easier to manage and debug each module separately.
- **Reusability:** Shared Blade components such as headers, footers, and layout files can be reused across different pages.
- **Testing:** Each unit can be independently tested for functionality.
- **Separation of concerns:** Controllers, models, and views are clearly separated following the MVC pattern, promoting cleaner development.

### 5.1.2 Scalability

Scalability ensures that the platform can handle increasing numbers of users, news articles, and traffic in the future. Key scalability features include:

- **Database scalability:** MySQL’s relational structure allows efficient storage and querying of news, users, categories, banners, likes, and notifications.
- **Component-based frontend:** Blade templates and Bootstrap 5 enable reusable UI components and consistent layouts across public and admin pages.
- **Route structure:** Laravel routes in `web.php` are organized by middleware groups (guest, auth, role, permission) to support easy extension of new features.
- **File storage support:** Images for news articles and banners are stored in Laravel’s public storage disk, making media handling scalable and reliable.
- **Asynchronous processing:** AJAX requests for likes, search, and notifications are handled without full page reloads to maintain performance.

## 5.2 Database Design

A well-structured database is essential for efficient data management. The Khmer News Portal uses MySQL to structure data in tables based on relationships and use cases.

### 5.2.1 Schema Design

The Khmer News Portal utilizes MySQL as its database, with Laravel Eloquent ORM as the data modeling tool to define and manage schemas. Each table is tailored to support specific components of the platform, such as user management, news content, interaction tracking, and notification systems.

**> Users Table (users)**

This table stores staff accounts and associated metadata.

- **id:** Primary key for each user
- **name:** Full name of the user
- **email:** Unique email address (used for login)
- **password:** Hashed password for secure authentication
- **bio:** Short biography (optional)
- **image:** Profile image path (optional)
- **email_verified_at:** Timestamp for email verification (optional)
- **remember_token:** Token for persistent login sessions
- **last_seen:** Timestamp for tracking online status
- **soft deletes:** Supports safe account removal without losing history
- **Timestamps:** `created_at` and `updated_at` for account records

**> Category Table (category)**

Stores news groupings for content organization.

- **id:** Primary key for each category
- **name:** Unique category name (e.g., sports, local news, technology)
- **views:** Total view count for articles in the category
- **Timestamps:** `created_at` and `updated_at`

**> News Table (news)**

Handles all news articles authored by staff members.

- **id:** Primary key for each article
- **title:** Title of the news article (Khmer UTF-8 supported)
- **content:** Full article body stored as rich HTML from CKEditor 5
- **image:** Main featured image path
- **images:** JSON array of additional images (optional)
- **audio:** Optional uploaded audio voice file path (MP3)
- **status:** Publication status (Pending, Accepted, Rejected)
- **is_pinned:** Boolean flag to feature article on homepage
- **user_id:** Foreign key referencing the author in `users`
- **category_id:** Foreign key referencing `category`
- **views:** Total number of article reads
- **Timestamps:** `created_at` and `updated_at`

**> Likes Table (likes)**

Tracks article likes from public readers using device-based identification.

- **id:** Primary key for each like record
- **device_id:** Unique UUID identifying the visitor’s device or session
- **news_id:** Foreign key referencing the liked article in `news`
- **Timestamps:** `created_at` and `updated_at`

**> Banners Table (banners)**

Manages sponsor advertisements displayed on the public site.

- **id:** Primary key for each banner
- **title:** Banner title for admin reference
- **image:** Banner image file path
- **url:** Optional destination link when banner is clicked
- **position:** Display location (`home`, `detail`, or `both`)
- **is_active:** Boolean flag to show or hide the banner
- **sort_order:** Integer for controlling banner display order
- **Timestamps:** `created_at` and `updated_at`

**> Notifications Table (notifications)**

Tracks in-app notifications for staff users.

- **id:** Primary key for each notification
- **data:** JSON text storing notification type and related details
- **read_at:** Timestamp indicating when the notification was read (nullable)
- **user_id:** Foreign key referencing the recipient in `users`
- **Timestamps:** `created_at` and `updated_at`

**> Permission Tables (Spatie)**

Managed by the Spatie Laravel Permission package for role-based access control.

- **roles:** Stores predefined roles (Super Admin, Editor, Writer)
- **permissions:** Stores granular permissions (Create News, Status News, etc.)
- **model_has_roles / role_has_permissions:** Pivot tables linking users to roles and permissions

### 5.2.2 Data Relationships

While MySQL is a relational database, the Khmer News Portal uses foreign key references and Eloquent ORM relationships to associate data across tables:

- A news article references the **Users** table via `user_id` (author).
- A news article references the **Category** table via `category_id`.
- A like record references the **News** table via `news_id`.
- A notification references the **Users** table via `user_id` (recipient).

Using Eloquent's relationship methods (e.g., `$news->author`, `$news->category`, `$news->likes`), related data can be fetched efficiently—such as displaying the author's name on an article page, listing news by category, or counting likes per article. This relational approach ensures data integrity, supports fast queries, and maintains consistency across the platform without compromising flexibility.

## 5.3 Feature Architecture

The Khmer News Portal is structured around a modular Laravel architecture that cleanly separates features into independent components across the frontend and backend. This architecture ensures scalability, maintainability, and support for future expansion. The project also integrates external services such as Google Cloud Text-to-Speech for Khmer audio news and Cloudflare for CDN caching and security.

### 5.3.1 Frontend Feature Architecture

The frontend, built with Laravel Blade templates, Bootstrap 5, and Vanilla JavaScript, is organized into self-contained views and components:

- **layouts:** Contains shared page structures such as `app.blade.php` (public site) and `admin.blade.php` (dashboard).
- **components:** Hosts reusable elements like `admin-header`, `admin-footer`, and `col-2` for consistent UI across pages.
- **Public views:** Includes top-level pages such as `home.blade.php`, `detail.blade.php`, `search-results.blade.php`, and `viewCategory.blade.php` for reader-facing content.
- **Admin views:** Includes management pages under `admin/` for news, categories, banners, and users.
- **News views:** Includes `create.blade.php`, `edit.blade.php`, `view.blade.php`, and `status.blade.php` for the content workflow.
- **public/js:** Contains dedicated scripts for likes (`like.js`), search (`search.js`), notifications (`notifications.js`), CKEditor (`ckeditor.js`), and image handling.

Interactive UI feedback is handled with Vanilla JavaScript and AJAX requests. CKEditor 5 is integrated for rich-text news editing, and Hotwire Turbo is used for fast page navigation without full reloads. Image previews and uploads are handled through dedicated JavaScript modules and secure backend storage routes.

### 5.3.2 Backend Feature Architecture

The backend is built using Laravel 11 and PHP 8.2, with a feature-driven design pattern. The main entry file is `bootstrap/app.php`, which initializes middleware, routes, and application configuration. Feature logic is split across controllers, models, services, events, and middleware.

**Key Backend Directories and Files:**

- **app/Models/** – Eloquent models defining database structure:
  - `News.php` – News content, author ref, category, views, and likes relationship.
  - `Like.php` – Device-based like tracking linked to news articles.
  - `Notification.php` – In-app notification tracking per user.
  - `User.php` – Stores user profile, authentication info, and role assignments.
  - `Category.php` – News category definitions and view counts.
  - `Banner.php` – Sponsor banner assets, links, and active status.
- **app/Http/Controllers/** – Route controllers handling business logic for news, auth, likes, categories, banners, users, and notifications.
- **app/Services/** – Service layer for reusable business logic (project-specific).
- **app/Events/ & app/Listeners/** – Event-driven notification handling for news creation and status updates.
- **app/Http/Middleware/** – Custom middleware such as `OnlineStatus.php` for tracking active users.
- **routes/web.php** – Defines all public and admin URL routes with middleware groups.
- **database/migrations/** – Version-controlled schema definitions for all database tables.
- **.env** – Stores sensitive configuration values like database credentials, app keys, and API tokens.

### 5.3.3 Feature Modules Overview

| Feature | Implementation Overview |
| :--- | :--- |
| User Authentication | Laravel session-based login/registration with Spatie RBAC for role control |
| News Management | CRUD operations with CKEditor 5 integration and draft/review workflow |
| Image Uploading | Secure file uploads stored in Laravel public disk with validation |
| Editorial Review | Editor role updates article status (Pending/Accepted/Rejected) before publication |
| Real-time Notifications | Event-driven notifications saved to DB and fetched via AJAX per user session |
| Admin Dashboard | Blade-based dashboard for managing news, categories, banners, and users |
| Category Filtering | Backend filtering logic by predefined categories (sports, local news, etc.) |
| View & Like Tracking | Each article tracks total views; likes stored per device via UUID in MySQL |
| Sponsor Banners | Dynamic banner carousel with active/inactive toggle and position control |
| Audio Voice (Optional) | Admin can upload an MP3 voice file per article and users can play it on the detail page |

### 5.3.4 Data Flow Overview

The Khmer News Portal employs a well-defined data flow architecture to ensure efficient, secure, and reliable communication between the frontend, backend, and database layers.

**Frontend to Backend Interaction**

User interactions on the Blade-based frontend trigger HTTP requests to Laravel routes defined in `web.php`. Form submissions and AJAX calls (for likes, search, and notifications) include CSRF tokens in the headers to securely validate requests. Protected admin routes require authenticated sessions and role/permission middleware before granting access.

**Backend Request Handling**

Upon receiving a request, the Laravel backend executes the relevant controller method, which validates input data, applies business logic, and interacts with the database through Eloquent ORM queries. This abstraction ensures data consistency and proper enforcement of access control based on user roles.

**Database Operations**

Eloquent queries translate into MySQL commands that perform CRUD operations on tables such as `news`, `users`, `category`, `likes`, `banners`, and `notifications`. The backend carefully manages transactional integrity and error handling to maintain robust and consistent data storage.

**Response Transmission**

After processing, the backend sends HTML responses (via Blade views) or JSON responses (for AJAX endpoints) back to the frontend, enabling dynamic UI updates and feedback. This cycle supports interactive features like article rendering, like count updates, search results, dashboard management, and notification alerts.

**Media Upload Flow**

For media handling, the data flow involves a secure multi-step process:

1. The frontend submits an image upload request through a form or CKEditor to the backend upload endpoint.
2. The backend validates the file type and size, then stores the image in Laravel's public storage disk (`storage/app/public/images/` or `storage/app/public/banners/`).
3. The stored file path is saved in the relevant database record (news article or banner).
4. Images are served to the browser through secure storage routes with caching headers for performance.

This approach ensures secure, scalable, and performant file management across the platform.

### 5.3.5 Summary

The feature architecture of the Khmer News Portal adopts a clean separation of concerns across Blade, Laravel, and MySQL layers. It leverages Laravel's built-in authentication and Spatie Permissions for secure role-based access, and Google Cloud Text-to-Speech for Khmer audio news. Each feature—from news creation to banner rotation and real-time likes—is designed to operate independently, yet integrate seamlessly, resulting in a modular system that supports high scalability, real-time interaction, and an excellent user experience for both readers and newsroom staff.

---

# CHAPTER 6: Implementations

## 6.1 Development Process

The development of the Khmer News Portal followed an Agile-based iterative approach, allowing for continuous testing and integration of new features. The development was divided into multiple phases:

1. **Requirement Gathering:** Based on the needs of Cambodian news readers and newsroom staff (writers, editors, and administrators).
2. **Planning:** Defined the project scope, prioritized features, and prepared the tech stack (Laravel 11, MySQL, Blade, Bootstrap 5).
3. **Designing:** Created wireframes and flow diagrams to visualize the system's architecture, database schema, and user flow.
4. **Implementation:** Code development was split into frontend (Blade views and JavaScript) and backend (Laravel controllers and models), using version control (Git) for tracking.
5. **Testing:** Conducted during and after implementation to ensure bug-free performance.
6. **Deployment:** The completed web application was hosted on Hostinger with Cloudflare for CDN caching and security.

Each sprint was followed by code reviews, testing, and improvements to ensure quality and maintainability.

## 6.2 Frameworks Implementation

The Khmer News Portal is built using the Laravel stack, along with various supporting libraries and services for a full-featured and scalable platform.

**➢ Frontend: Blade + Bootstrap 5**

- Built a modular view architecture with reusable layouts and components.
- Used Laravel Blade templates for consistent page structure across public and admin interfaces.
- Added CKEditor 5 for rich-text news article editing.
- Integrated Hotwire Turbo for fast page navigation without full reloads.
- Implemented Vanilla JavaScript and AJAX for real-time likes, search, and notifications.

**➢ Backend: Laravel 11 with PHP 8.2**

- Developed web routes and controllers to handle news, category, banner, user, like, and notification operations.
- Middleware for authentication, online status tracking, and Spatie role-based access control.
- Input validation and error handling on all form submissions and AJAX requests.

**➢ Database: MySQL with Eloquent ORM**

- Defined models and migrations for User, News, Category, Like, Banner, and Notification.
- Used Eloquent relationships for relational data retrieval (author, category, likes).

**➢ Other Integrations:**

- **Spatie Laravel Permission:** For role-based access control (Super Admin, Editor, Writer).
- **Google Cloud Text-to-Speech:** For generating Khmer audio news on article pages.
- **Laravel Storage:** For secure news and banner image uploads.
- **Cloudflare:** For CDN caching, SSL, and performance optimization on production.
- **Git & GitHub:** For version control and collaborative development tracking.

## 6.3 Testing and Debugging

To ensure reliability and performance, a variety of testing and debugging techniques were used:

**➢ Manual Testing**

- Each feature was manually tested in multiple browsers and devices for responsiveness and performance.
- UI/UX validation was done to ensure mobile-first usability across the public news site and admin dashboard.

**➢ Functional Testing**

- Verified functionalities like news creation, editing, draft saving, editorial review, notifications, search, and banner management.
- Checked role-based access control (e.g., only Writers can create articles; only Editors can update status; only Super Admins can delete news and manage users).
- Tested the real-time Like button to confirm counts update correctly without page reload.

**➢ Debugging Tools**

- Chrome DevTools for inspecting frontend issues and AJAX responses.
- Laravel Debugbar for backend performance monitoring and query tracing during development.
- Laravel's built-in testing tools for validating controller and route behaviour.

**➢ Bug Tracking**

- Maintained a bug log to record issues found during testing.
- Used Git branches to isolate and fix bugs before merging to the main codebase.
- Fixed specific issues such as search errors in `NewsController.php` and image display problems in Blade templates.

---

# CHAPTER 7: ANALYSIS AND RESULTS

## 7.1 System Results and Performance

After successful implementation and deployment, the Khmer News Portal was tested for both functionality and performance. The platform met the core requirements and offered a seamless user experience for both public readers and newsroom staff. Below are the observed results:

**Key Achievements:**

- **Responsive Interface:** The web application functioned well across various screen sizes and devices due to the mobile-first responsive design using Bootstrap 5.
- **Authentication System:** Laravel session-based login and registration worked reliably, with Spatie role-based access control ensuring secure access for Super Admin, Editor, and Writer roles.
- **News Editor Functionality:** CKEditor 5 integration allowed staff to create professionally formatted news articles with images, headings, and rich text content.
- **Search and Filtering:** Readers could easily search news articles by keywords and browse content by predefined categories.
- **Notification System:** Real-time in-app notification updates kept staff informed about article submissions and status changes.
- **Like System:** The AJAX-based like feature worked as expected, updating article like counts instantly without page reload.
- **Sponsor Banner System:** The dynamic banner carousel successfully displayed and rotated multiple active sponsor advertisements across the public site.
- **Performance:** The system showed low load times and efficient handling of user actions, with optimized database queries and Hotwire Turbo for fast navigation.
- **Dark Mode Support:** A fully integrated dark mode option was implemented, improving visual ergonomics in low-light environments. Users could toggle between light and dark themes for a more comfortable reading experience.
- **Khmer Text-to-Speech:** Google Cloud TTS integration enabled readers to listen to Khmer news articles, improving accessibility for users who prefer audio content.

These features combined to make the Khmer News Portal highly usable and efficient for Cambodian news readers and content management staff.

## 7.2 Evaluation Against Objectives

The project aimed to create a functional, user-friendly, and modern Khmer news portal tailored for Cambodian audiences and newsroom administrators. Here's how the implementation measured against the original objectives:

| Objective | Evaluation Result |
| --- | --- |
| Develop a secure backend with Laravel to manage news articles, categories, and user accounts | ☑ Laravel backend with MySQL, Eloquent ORM, and Spatie RBAC implemented successfully |
| Implement a real-time "Like" feature so readers can interact without reloading the page | ☑ AJAX-based like/unlike system with instant count updates completed |
| Create a dynamic sponsor banner system that displays and rotates multiple advertisements | ☑ Banner carousel with active/inactive toggle and position control fully functional |
| Design a clean and responsive public interface using HTML, CSS, JavaScript, and Blade | ☑ Responsive public site with Bootstrap 5, dark mode, and Hotwire Turbo completed |
| Provide an administrative dashboard for creating, editing, and organizing news content | ☑ Full admin dashboard with news workflow, categories, banners, and user management |
| Implement a search function that allows readers to find news articles quickly by keywords | ☑ Integrated keyword search with category browsing working as required |
| Test and evaluate the system to ensure it meets functional and non-functional requirements | ☑ Manual and functional testing completed; all core requirements verified |

**Figure 6: Objective and evaluation result**

---

# CHAPTER 8: DISCUSSION

## 8.1 Interpretation of Results

The results obtained from the development and implementation of the Khmer News Portal indicate that a modern, responsive, and user-focused news platform can be effectively built using the Laravel stack (PHP, Laravel 11, MySQL, Blade, and JavaScript). The use of **CKEditor 5** enhanced content creation through intuitive rich-text editing, while **Laravel authentication with Spatie RBAC** simplified secure access for Super Admin, Editor, and Writer roles. Features like **search functionality**, **real-time likes**, **notifications**, **sponsor banner management**, and **profile management** aligned well with the objectives. The platform provides a fast, dynamic news reading and content management experience that prioritizes both usability and performance. The integration of Hotwire Turbo, AJAX interactions, dark mode, and Khmer Text-to-Speech significantly improves user satisfaction, accessibility, and engagement for Cambodian audiences.

## 8.2 Challenges and Limitations of the Study

Despite the overall success of the platform, several challenges and limitations were encountered during development:

- **Third-party Integration Complexity:** Integrating CKEditor 5, Google Cloud Text-to-Speech, and Cloudflare CDN required careful configuration and introduced occasional compatibility issues during setup.
- **Time Constraints:** Due to project deadlines, some advanced features such as public user commenting, detailed banner analytics, and email notifications were postponed.
- **Testing Limitations:** The system was primarily tested in a development environment with a limited number of users, which may not reflect performance under high traffic.
- **Security Considerations:** While Laravel authentication and CSRF protection ensure secure access, additional measures like rate limiting, advanced input sanitization, and more robust API security are areas for future improvement.
- **No Mobile App Support:** The platform was designed to be mobile-responsive, but native mobile app development for iOS and Android was outside the project scope.
- **No Public Commenting:** Readers can like articles but cannot post comments, limiting community discussion compared to platforms like ThmeyThmey.
- **Single Language Support:** The platform currently supports only Khmer content, with no multi-language or translation feature implemented.

## 8.3 Comparison with Existing Systems

When compared with existing platforms such as **WordPress-based CMS**, **TVK News**, and **ThmeyThmey**, the Khmer News Portal offers the following distinctions:

| Feature | Khmer News Portal | WordPress / TVK / ThmeyThmey |
| --- | --- | --- |
| Modern Laravel MVC Architecture | ☑ Fully implemented | ☒ Mostly WordPress or custom CMS |
| Built-in AJAX Likes | ☑ Fully implemented | ☒ Not commonly available |
| Dynamic Ad Banner Slider | ☑ Fully implemented | ☒ Limited or plugin-dependent |
| Khmer Text-to-Speech (TTS) | ☑ Integrated | ☒ Not available |
| Native Dark Mode | ☑ Fully implemented | ☒ Not commonly available |
| Role-Based Access Control (RBAC) | ☑ Super Admin, Editor, Writer | ☒ Basic or limited permissions |
| Hotwire Turbo (Fast Navigation) | ☑ Integrated | ☒ Traditional page loads |
| Public Commenting | ☒ Not included | ☑ Available on some platforms |
| Secure Authentication | ☑ Laravel session-based | ☑ Available on most platforms |
| Responsiveness & Design | ☑ Fully responsive with modern UI | ☑ Responsive, but design varies |

**Figure 7: Comparison with Existing Systems**

While larger platforms like ThmeyThmey offer extensive content coverage and public commenting, the Khmer News Portal excels in simplicity, customizability, and user-centered features specifically designed for Cambodian news readers and newsroom staff. Its native AJAX likes, dynamic banner system, Khmer TTS, and role-based content workflow provide a more modern and accessible experience than many traditional WordPress-based or government-run news portals in Cambodia.

---

# CHAPTER 9: CONCLUSION

## 9.1 Summary

The Khmer News Portal project aimed to develop a modern, user-friendly, and dynamic web application using the Laravel framework. Throughout the process, the project covered every major phase of development: system design, implementation, testing, and evaluation. Key features such as a modular **CKEditor 5**-based news editor, **Laravel authentication with Spatie RBAC** for staff access, a role-based admin dashboard, searchable news content, real-time notifications, AJAX-based article likes, and a dynamic sponsor banner system were successfully implemented.

The project not only met its functional objectives but also demonstrated the efficiency of integrating modern web development technologies into a cohesive system that enhances user experience, promotes usability, and supports scalability for Cambodian news readers and newsroom administrators.

## 9.2 Future Work

Although the Khmer News Portal currently delivers core news publishing functionalities and a modern user experience, several future enhancements can broaden its capabilities, improve performance, and support wider adoption. Below is a detailed overview of potential improvements, including their rationale and suggested functional flow:

##### **1. Mobile Application Development**

**Description:** Building native mobile apps using React Native or Flutter will enable a consistent cross-platform experience, extend reader reach, and leverage device-native features like push notifications and offline reading.

**Technology Stack:**

- **Frontend:** React Native or Flutter
- **Backend:** Laravel 11 REST API (same database as web version)
- **APIs:** RESTful endpoints for news, categories, likes, and banners
- **Local Storage:** SQLite or AsyncStorage for offline article caching

- **Push Notifications:** Firebase Cloud Messaging (FCM)

**Functional Flow:**

1. Users download the app from Google Play or App Store.
2. Upon launch, the app fetches news content via Laravel API endpoints.
3. API calls retrieve articles, categories, and banner data.
4. Background sync caches articles for offline reading.
5. FCM sends real-time alerts for breaking news or new published articles.

##### **2. Public User Accounts and Commenting System**

**Description:** Allowing readers to register accounts and comment on articles will increase community engagement and bring the platform closer to popular portals like ThmeyThmey.

**Technologies:**

- **Authentication:** Laravel Breeze or Sanctum for public user registration
- **Comments:** Nested comment schema in MySQL with parent-child relationships
- **Moderation:** Admin dashboard tools to approve, delete, or flag comments

**Implementation Flow:**

1. Readers register and log in through a public account page.
2. Authenticated users can post comments and replies on article detail pages.
3. Comments are stored in a dedicated database table linked to news articles.
4. Editors or Super Admins review and moderate comments from the dashboard.
5. AJAX loads new comments without full page reload.

##### **3. Advanced Analytics Dashboard**

**Description:** Empowers administrators to optimize content and measure advertising performance with detailed engagement data.

**Technologies:**

- **Tracking:** Google Analytics, Laravel event logging, or custom tracking middleware
- **Visualization:** Chart.js or ApexCharts integrated into the admin dashboard
- **Backend:** MySQL aggregations for views, likes, category performance, and banner impressions

**Flow:**

1. Each article view, like, and banner impression is tracked via backend events.
2. Events are logged to the database or an analytics service.
3. Backend aggregates data (e.g., total reads per article, popular categories, banner click rates).
4. Dashboard visualizes metrics with export options (CSV, PDF).

##### **4. Banner Click Tracking and Sponsor Analytics**

**Description:** Provides administrators with measurable data on sponsor banner performance to support advertising decisions and revenue growth.

**Technologies:**

- **Click Tracking:** JavaScript event listeners with AJAX logging to Laravel backend
- **Database:** New `banner_clicks` table with banner ID, timestamp, and session data
- **Reporting:** Admin dashboard charts showing impressions vs. clicks per banner

**Flow:**

1. User clicks a sponsor banner on the public site.
2. JavaScript sends an AJAX request to log the click event.
3. Backend stores the click record linked to the banner ID.
4. Admin dashboard displays click-through rates and impression statistics per banner.

##### **5. Email Notification System**

**Description:** Extends the current in-app notification system to send email alerts for important events such as article approvals, new submissions, and breaking news.

**Technologies:**

- **Email Service:** Laravel Mail with SMTP, SendGrid, or Mailgun
- **Queue System:** Laravel Queues for asynchronous email delivery
- **Templates:** Blade-based HTML email templates

**Flow:**

1. A triggering event occurs (e.g., article submitted, status changed).
2. Laravel dispatches a queued email job to the notification recipient.
3. The email service delivers a formatted notification to the user's inbox.
4. Users can manage email preferences from their profile settings.

##### **6. Multi-language Support**

**Description:** Enables the platform to serve both Khmer and English audiences, expanding reach beyond local readers.

**Technologies:**

- **i18n Libraries:** Laravel localization (`lang/` files) for UI strings
- **AI Translation:** Google Cloud Translation API or DeepL API for article content
- **Multilingual Posts:** Optional English fields in the news database schema

**Flow:**

1. UI strings are defined in language files (`lang/km/`, `lang/en/`).
2. Users choose a language from the site header or settings.
3. Articles display in the selected language where translations are available.
4. Authors can provide manual translations or opt for AI-generated versions.

##### **7. AI-Powered Content Tools**

**Description:** Builds on the existing Khmer Text-to-Speech feature with additional AI capabilities for content creation and reader personalization.

**Technologies:**

- **Text-to-Speech:** Google Cloud TTS (already integrated)
- **Content Recommendations:** Machine learning model or OpenAI API for personalized article suggestions
- **SEO Optimization:** GPT-based keyword analysis for article titles and summaries
- **Auto-summarization:** NLP model to generate short article excerpts

**Flow:**

- **TTS:** Article text is sent to Google Cloud TTS and returns an audio file stored on the server.
- **Recommendations:** Reader browsing history is analyzed to suggest related articles on the homepage.
- **SEO:** Author submits a draft; AI returns keyword and title suggestions before publication.

##### **8. Social Media Integration**

**Description:** Allows readers to share news articles directly to popular social platforms, increasing traffic and platform visibility.

**Technologies:**

- **Share APIs:** Facebook Share Dialog, Twitter/X Web Intent, Telegram share links
- **Open Graph Meta Tags:** Laravel Blade meta tags for rich link previews

**Flow:**

1. Share buttons appear on each article detail page.
2. User clicks a platform icon (Facebook, Telegram, etc.).
3. The platform opens with a pre-filled link and article title.
4. Open Graph tags ensure rich previews with article image and description.

## 9.3 Final Remarks

The Khmer News Portal has reached a pivotal milestone—delivering a reliable, modern, and extensible news platform for Cambodian readers and newsroom staff. However, in a competitive digital landscape, continuous innovation is vital.

The proposed features are not just enhancements but strategic evolutions:

- Mobile apps will improve accessibility and engagement across demographics.
- Public commenting and user accounts will foster community interaction comparable to established local news portals.
- Advanced analytics and banner tracking will empower administrators with data-driven content and advertising decisions.
- Email notifications, multi-language support, and social media integration will bring the platform closer to global and enterprise-grade standards.
- AI-powered tools will further improve accessibility and content quality for Khmer-speaking audiences.

From a technical standpoint, each enhancement can be integrated modularly within the existing Laravel architecture, leveraging REST APIs, cloud services, Laravel Queues, and containerized deployments for scalability. CI/CD pipelines via GitHub can ensure new features are tested and deployed smoothly on Hostinger with Cloudflare CDN.

Looking ahead, the vision for the Khmer News Portal is to evolve into a full-scale intelligent digital news ecosystem—offering the combined power of fast delivery, community engagement, and accessible Khmer content. By embracing these future directions, the platform can transcend traditional CMS-based news websites and become a cornerstone in the next generation of smart, accessible, and reader-first digital news platforms in Cambodia.

---

# REFERENCES

Otwell T. Laravel Documentation [Internet]. Laravel LLC; 2026 [cited 2026 May 15]. Available from: [https://laravel.com/docs](https://laravel.com/docs)

PHP Group. PHP Manual [Internet]. The PHP Group; 2026 [cited 2026 May 12]. Available from: [https://www.php.net/manual/en/](https://www.php.net/manual/en/)

Oracle Corporation. MySQL 8.0 Reference Manual [Internet]. Oracle; 2026 [cited 2026 May 10]. Available from: [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)

Bootstrap Team. Bootstrap 5 Documentation [Internet]. Bootstrap; 2026 [cited 2026 May 8]. Available from: [https://getbootstrap.com/docs/5.3/](https://getbootstrap.com/docs/5.3/)

CKEditor. CKEditor 5 – Rich Text Editor [Internet]. CKSource; 2026 [cited 2026 May 7]. Available from: [https://ckeditor.com/docs/ckeditor5/latest/](https://ckeditor.com/docs/ckeditor5/latest/)

Spatie. Laravel Permission Documentation [Internet]. Spatie; 2026 [cited 2026 May 6]. Available from: [https://spatie.be/docs/laravel-permission/v6/introduction](https://spatie.be/docs/laravel-permission/v6/introduction)

Google Cloud. Cloud Text-to-Speech Documentation [Internet]. Google; 2026 [cited 2026 May 9]. Available from: [https://cloud.google.com/text-to-speech/docs](https://cloud.google.com/text-to-speech/docs)

Hotwired. Turbo Handbook [Internet]. Hotwired; 2026 [cited 2026 May 5]. Available from: [https://turbo.hotwired.dev/handbook/introduction](https://turbo.hotwired.dev/handbook/introduction)

Mozilla Developer Network. MDN Web Docs – JavaScript [Internet]. Mozilla; 2026 [cited 2026 May 3]. Available from: [https://developer.mozilla.org/en-US/docs/Web/JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

W3Schools. HTML, CSS, and JavaScript Tutorials [Internet]. Refsnes Data; 2026 [cited 2026 May 1]. Available from: [https://www.w3schools.com/](https://www.w3schools.com/)

Cloudflare, Inc. Cloudflare Documentation [Internet]. Cloudflare; 2026 [cited 2026 May 11]. Available from: [https://developers.cloudflare.com/](https://developers.cloudflare.com/)

GitHub, Inc. Git Documentation [Internet]. GitHub; 2026 [cited 2026 May 4]. Available from: [https://git-scm.com/doc](https://git-scm.com/doc)

Sommerville I. *Software Engineering*. 10th ed. Pearson; 2016.

---

# APPENDICES

**Appendix A: Code Snippet - Dynamic Banner Implementation**

This snippet from `home.blade.php` shows how the dynamic carousel iterates over all active banners from the database, eliminating the previous single-banner limit:

```html
@if(isset($homeBanners) && $homeBanners->count() > 0)
<div class="carousel slide rounded overflow-hidden shadow-lg" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($homeBanners as $i => $banner)
        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
            <a href="{{ $banner->url }}">
                <img src="{{ asset('storage/banners/' . $banner->image) }}" class="d-block w-100 responsive-home-banner shadow">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif
```

**Appendix B: Code Snippet - Live "Like" Functionality**

The "Like" functionality requires coordination between the frontend JavaScript and backend Laravel Controller to update counts without reloading the page.

**`public/js/like.js`:**
```javascript
const likeBtns = document.querySelectorAll('.like-btn');
likeBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('data-form-id') ? document.getElementById(this.getAttribute('data-form-id')).action : null;
        
        fetch(url, {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                'Accept': 'application/json' 
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                this.querySelector('.like-count').textContent = data.likes;
            }
        });
    });
});
```

**`LikeController.php`:**
```php
public function likeNews(Request $request, News $news)
{
    $deviceId = $request->session()->get('device_id') ?? Str::uuid()->toString();
    $request->session()->put('device_id', $deviceId);

    $like = Like::where('device_id', $deviceId)->where('news_id', $news->id)->first();

    if ($like) {
        $like->delete();
        $hasLiked = false;
    } else {
        Like::create(['device_id' => $deviceId, 'news_id' => $news->id]);
        $hasLiked = true;
    }

    return response()->json([
        'success' => true,
        'likes' => $news->likes()->count(),
        'has_liked' => $hasLiked,
    ]);
}
```
