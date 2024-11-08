-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 09:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripviz`
--

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_key` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `preview_image` text DEFAULT NULL,
  `template_path` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_key`, `name`, `preview_image`, `template_path`, `category`, `created_at`, `updated_at`, `status`) VALUES
(2, 'cities_with_tour_count_slider', 'Cities with Tour Count (Slider)', 'uploads/Sections/preview-images/f3008e69-8500-4dc3-bf04-76738f1737e4.png', 'locations.cities-tour-count-slider', 'Location Sections', '2024-10-29 19:56:48', '2024-10-30 14:23:09', 'active'),
(3, 'cities_with_tour_count_list', 'Cities with Tour Count (List)', 'uploads/Sections/preview-images/fdd8fbab-4f65-49d2-9f17-a27738fe0b87.png', 'locations.cities-tour-count-list', 'Location Sections', '2024-10-29 19:57:01', '2024-10-30 14:23:05', 'active'),
(4, 'popular_cities_slider', 'Popular Cities (Slider)', 'uploads/Sections/preview-images/b37be5a8-53dc-437e-b44f-1fdfb8a51829.png', 'locations.popular-slider', 'Location Sections', '2024-10-29 19:57:14', '2024-10-30 14:23:01', 'active'),
(5, 'tours_grid_5_item', 'Tours: Grid (5-Item)', 'uploads/Sections/preview-images/004e102d-dc45-44e3-bf39-03402be85ce0.png', 'tours.grid-5', 'Tour Sections', '2024-10-29 19:57:29', '2024-10-30 14:22:57', 'active'),
(6, 'tours_grid_4_item', 'Tours: Grid (4-Item)', 'uploads/Sections/preview-images/f607496c-f3ca-45ce-aa07-39f34f7e83db.png', 'tours.grid-4', 'Tour Sections', '2024-10-29 19:58:13', '2024-10-30 14:22:51', 'active'),
(7, 'tours_grid_3_item', 'Tours: Grid (3-Item)', 'uploads/Sections/preview-images/ca0f7c2a-62b5-4b02-b779-83bff1401265.png', 'tours.grid-3', 'Tour Sections', '2024-10-29 19:58:50', '2024-10-30 14:22:47', 'active'),
(8, 'trending_tours_slider', 'Trending Tours (Slider)', 'uploads/Sections/preview-images/847b4340-b7a5-46dd-ae84-4e0b483f8122.png', 'tours.trending-slider', 'Tour Sections', '2024-10-29 19:59:11', '2024-10-30 14:22:40', 'active'),
(9, 'water_activities_3_box_layout', 'Water Activities: 3-Box Layout', 'uploads/Sections/preview-images/9aa0d8b8-a737-48d4-ac44-a5686540232c.png', 'activities.grid-3', 'Activities Sections', '2024-10-29 19:59:33', '2024-10-30 14:22:35', 'active'),
(10, 'water_activities_4_item_grid', 'Water Activities: 4-Item Grid', 'uploads/Sections/preview-images/2936beda-e145-43fe-a11c-bf25f0d705ef.png', 'activities.grid-4', 'Activities Sections', '2024-10-29 20:00:03', '2024-10-30 14:22:28', 'active'),
(11, 'call_to_action_standard', 'Call-to-Action: Standard', 'uploads/Sections/preview-images/aa9242d0-8353-497b-a2d7-18f8025baaa5.png', 'ctas.standard', 'Call-to-Action', '2024-10-29 20:00:16', '2024-10-30 14:22:24', 'active'),
(12, 'call_to_action_counter_style', 'Call-to-Action: Counter Style', 'uploads/Sections/preview-images/26b2f39f-de5a-4f9e-ab5c-48bd1e86c95a.png', 'ctas.counter', 'Call-to-Action', '2024-10-29 20:00:29', '2024-10-30 14:22:18', 'active'),
(13, 'news_section', 'News Section', 'uploads/Sections/preview-images/9fd0f604-7f88-4d42-bef5-f5218ba8d784.png', 'others.news-standard', 'Other Content', '2024-10-29 20:00:51', '2024-10-30 14:22:13', 'active'),
(14, 'testimonials_section', 'Testimonials Section', 'uploads/Sections/preview-images/0d014c9a-b95f-4b0a-a668-0814fc46b8c4.png', 'others.testimonials', 'Other Content', '2024-10-29 20:01:11', '2024-10-30 14:22:07', 'active'),
(15, 'newsletter_signup', 'Newsletter Signup', 'uploads/Sections/preview-images/0ea3d7f0-63c5-4107-818d-0b8f5e9d4833.png', 'others.newsletter', 'Other Content', '2024-10-29 20:01:26', '2024-10-30 14:22:03', 'active'),
(16, 'contact_section_standard', 'Contact Section: Standard', 'uploads/Sections/preview-images/7242bf33-b809-4456-a59d-50cde1d15d3b.png', 'others.contact-details', 'Other Content', '2024-10-29 20:01:44', '2024-10-30 14:21:56', 'active'),
(17, 'travel_promotions', 'Travel Promotions', 'uploads/Sections/preview-images/8e289d00-46a1-4f9d-8309-6e96f04da752.png', 'others.promotions', 'Other Content', '2024-10-29 20:01:59', '2024-10-30 14:21:48', 'active'),
(18, 'app_download', 'App Download', 'uploads/Sections/preview-images/79a3ce70-d6b1-4d1d-bcad-8fe1d550e85f.png', 'others.app', 'Other Content', '2024-10-29 20:02:12', '2024-10-30 14:19:21', 'active'),
(21, 'slider_carousel', 'Slider Carousel', 'uploads/Sections/preview-images/bd62c105-a4f2-4b89-a0e9-f73436611703.png', 'banners.carousel', 'Banner Sections', '2024-11-08 15:19:38', '2024-11-08 15:22:47', 'active'),
(22, 'layout_normal_background_color', 'Layout Normal: Background Color', 'uploads/Sections/preview-images/efad48d8-071e-4022-8b9e-1a50f4574209.png', 'banners.color-background', 'Banner Sections', '2024-11-08 15:20:04', '2024-11-08 15:22:39', 'active'),
(23, 'normal_v2_full_screen_background', 'Normal V2: Full-Screen Background', 'uploads/Sections/preview-images/00fc01cb-b7f3-4b3e-b3e2-ad3d80e95b74.png', 'banners.image-background', 'Banner Sections', '2024-11-08 15:20:29', '2024-11-08 15:22:29', 'active'),
(24, 'normal_v1_right_side_image', 'Normal V1: Right Side Image', 'uploads/Sections/preview-images/85dd3333-cda4-4e50-882f-736134aa0c2b.png', 'banners.right-image', 'Banner Sections', '2024-11-08 15:20:49', '2024-11-08 15:22:21', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
