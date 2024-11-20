-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 04:09 AM
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
(2, 'cities_with_tour_count_slider', 'Cities with Tour Count (Slider)', 'uploads/Sections/preview-images/f3008e69-8500-4dc3-bf04-76738f1737e4.png', 'locations.destinations', 'Location Sections', '2024-10-29 14:56:48', '2024-11-20 01:34:19', 'active'),
(3, 'cities_with_tour_count_list', 'Cities with Tour Count (List)', 'uploads/Sections/preview-images/fdd8fbab-4f65-49d2-9f17-a27738fe0b87.png', 'locations.top-location', 'Location Sections', '2024-10-29 14:57:01', '2024-11-20 01:46:55', 'active'),
(4, 'popular_cities_slider', 'Popular Cities (Slider)', 'uploads/Sections/preview-images/b37be5a8-53dc-437e-b44f-1fdfb8a51829.png', 'locations.popular', 'Location Sections', '2024-10-29 14:57:14', '2024-11-20 02:43:22', 'active'),
(9, 'water_activities_3_box_layout', 'Water Activities: 3-Box Layout', 'uploads/Sections/preview-images/9aa0d8b8-a737-48d4-ac44-a5686540232c.png', 'activities.grid-3', 'Promotion Sections', '2024-10-29 14:59:33', '2024-11-20 00:16:23', 'active'),
(11, 'call_to_action_standard', 'Call-to-Action: Standard', 'uploads/Sections/preview-images/aa9242d0-8353-497b-a2d7-18f8025baaa5.png', 'ctas.standard', 'Call-to-Action', '2024-10-29 15:00:16', '2024-10-30 09:22:24', 'active'),
(12, 'call_to_action_counter_style', 'Call-to-Action: Counter Style', 'uploads/Sections/preview-images/26b2f39f-de5a-4f9e-ab5c-48bd1e86c95a.png', 'ctas.counter', 'Call-to-Action', '2024-10-29 15:00:29', '2024-10-30 09:22:18', 'active'),
(13, 'news_section', 'News Section', 'uploads/Sections/preview-images/9fd0f604-7f88-4d42-bef5-f5218ba8d784.png', 'others.news-standard', 'Other Content', '2024-10-29 15:00:51', '2024-10-30 09:22:13', 'active'),
(14, 'testimonials_section', 'Testimonials Section', 'uploads/Sections/preview-images/0d014c9a-b95f-4b0a-a668-0814fc46b8c4.png', 'others.testimonials', 'Other Content', '2024-10-29 15:01:11', '2024-10-30 09:22:07', 'active'),
(15, 'newsletter_signup', 'Newsletter Signup', 'uploads/Sections/preview-images/0ea3d7f0-63c5-4107-818d-0b8f5e9d4833.png', 'others.newsletter', 'Other Content', '2024-10-29 15:01:26', '2024-10-30 09:22:03', 'active'),
(16, 'contact_section_standard', 'Contact Section: Standard', 'uploads/Sections/preview-images/7242bf33-b809-4456-a59d-50cde1d15d3b.png', 'others.contact-details', 'Other Content', '2024-10-29 15:01:44', '2024-10-30 09:21:56', 'active'),
(17, 'travel_promotions', 'Travel Promotions', 'uploads/Sections/preview-images/8e289d00-46a1-4f9d-8309-6e96f04da752.png', 'promotions.promotion', 'Promotion Sections', '2024-10-29 15:01:59', '2024-11-20 00:38:04', 'active'),
(18, 'app_download', 'App Download', 'uploads/Sections/preview-images/79a3ce70-d6b1-4d1d-bcad-8fe1d550e85f.png', 'others.app', 'Other Content', '2024-10-29 15:02:12', '2024-10-30 09:19:21', 'active'),
(25, 'banner', 'Banner', 'uploads/Sections/preview-images/5fa39323-0935-4f5f-a04e-35959257ce4e.png', 'banners.banner', 'Banner Sections', '2024-11-12 22:33:07', '2024-11-12 22:33:08', 'active'),
(26, 'tour_block', 'Tour block', 'uploads/Sections/preview-images/5ec5929c-67aa-41e5-9a56-a99e6b7ce0e8.png', 'tours.tour', 'Tour Sections', '2024-11-15 22:39:26', '2024-11-15 22:39:26', 'active');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
