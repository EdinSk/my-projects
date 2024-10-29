-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 11:47 PM
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
-- Database: `public_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `first_name`, `last_name`, `bio`, `is_deleted`) VALUES
(1, 'Isaac', 'Asimov', 'Isaac Asimov was an American writer and professor of biochemistry at Boston University.', 0),
(2, 'J.K.', 'Rowling', 'J.K. Rowling is a British author, best known for writing the Harry Potter series.', 0),
(3, 'Edin', 'Skoko', 'Edin Skoko was an American writer and professor of biochemistry at Boston University.	Edin Skoko was an American writer and professor of biochemistry at Boston University.	\r\n', 0),
(5, 'F. Scott', 'Fitzgerald', 'American novelist and short story writer, widely regarded as one of the greatest American writers of the 20th century.', 0),
(6, 'Harper', 'Lee', 'American novelist best known for her novel To Kill a Mockingbird.', 0),
(7, 'George', 'Orwell', 'English novelist and essayist, journalist and critic, famous for his novels Animal Farm and 1984.', 0),
(8, 'Jane', 'Austen', 'English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century.', 0),
(9, 'J.D.', 'Salinger', 'American writer known for his widely read novel The Catcher in the Rye.', 0),
(10, 'Fyodor', 'Dostoevsky', 'Fyodor Mikhailovich Dostoevsky was born on November 11, 1821, in Moscow, Russia. He was the second of seven children of Mikhail Andreevich and Maria Dostoevsky. His father, a doctor, was a member of the Russian nobility, owned serfs and had a considerable estate near Moscow where he lived with his family. It\'s believed that he was murdered by his own serfs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `author_id` int(11) NOT NULL,
  `year_of_publication` int(11) NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `author_id`, `year_of_publication`, `number_of_pages`, `image_url`, `category_id`, `is_deleted`) VALUES
(21, 'The Great Gatsby', 5, 1925, 180, 'images/book-images/images_1.png', 15, 0),
(22, 'To Kill a Mockingbird', 6, 1960, 281, 'images/book-images/images_2.png', 15, 0),
(23, '1984', 7, 1949, 328, 'images/book-images/images_3.png', 16, 0),
(24, 'Pride and Prejudice', 8, 1813, 279, 'images/book-images/images_4.png', 17, 0),
(25, 'The Catcher in the Rye', 9, 1951, 214, 'images/book-images/images_5.png', 16, 0),
(29, 'The Brothers Karamazov', 10, 1989, 900, 'images/book-images/the-brothers-karamazov-233.jpg', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `is_deleted`) VALUES
(11, 'Horror', 0),
(15, 'Fiction', 0),
(16, 'Dystopian', 0),
(17, 'Classic Literature', 0),
(18, 'Array', 1),
(19, 'Array', 1),
(20, 'Fantasy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_rejected` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `book_id`, `content`, `is_approved`, `is_rejected`, `created_at`) VALUES
(16, 26, 25, 'hehehehe', 1, 0, '2024-10-29 01:47:52'),
(17, 28, 21, 'qweqwe', 1, 0, '2024-10-29 19:27:58'),
(18, 28, 21, 'qwe', 1, 0, '2024-10-29 19:28:03'),
(19, 29, 21, 'qweqeqwe', 1, 0, '2024-10-29 22:41:46'),
(20, 29, 21, 'asdqweq', 0, 0, '2024-10-29 22:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `user_id`, `book_id`, `content`, `created_at`) VALUES
(5, 28, 21, 'qweqwe', '2024-10-29 22:34:13'),
(6, 28, 21, 'qweqweqw', '2024-10-29 22:34:16'),
(8, 28, 21, 'qweqweqweqwe', '2024-10-29 22:34:21'),
(9, 28, 21, 'qweqweqw', '2024-10-29 22:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `email`, `role`, `username`) VALUES
(28, '$2y$10$ELgzxIn0cSN50vBPoK2Zv.lDyvVztFFdp9TK9uGZA/6Yv5kT4tgPe', 'admin@example.com', 'admin', 'admin123'),
(29, '$2y$10$L02cKcOX4R2uJXgT4/E2YOi1EwKFnmjs1DT/NxygY/JqBUXvq1Bhi', 'edin@example.com', 'user', 'edin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
