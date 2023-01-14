/* 1. Create database */

DROP DATABASE IF EXISTS `slim4-simple-blog`;
CREATE DATABASE `slim4-simple-blog`;
USE `slim4-simple-blog`;

/* 2. Create posts table */

CREATE TABLE post (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE KEY,
  image_path varchar(255) NULL,
  content TEXT DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  published_date DATETIME NOT NULL
) ENGINE=InnoDB;

/* 3. Add 3 posts into the posts table */

INSERT INTO `post` (`id`, `title`, `slug`, `image_path`, `content`, `description`, `published_date`) VALUES
(NULL, 'First post', 'first-post', 'https://dummyimage.com/600x150/8d8d8d/e5e5e5', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.', 'My first blog post', '2020-12-05 18:00:00'),
(NULL, 'Second post', 'second-post', 'https://dummyimage.com/600x150/8d8d8d/e5e5e5', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.', 'My second blog post', '2020-12-10 12:00:00'),
(NULL, 'Third post', 'third-post', 'https://dummyimage.com/600x150/8d8d8d/e5e5e5', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you nee, or non-characteristic words etc.', 'My third blog post', '2020-12-15 15:00:00'); 