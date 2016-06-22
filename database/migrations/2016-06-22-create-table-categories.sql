
--
-- Table structure for table `fmi_categories`
--

CREATE TABLE `fmi_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fmi_categories`
--
ALTER TABLE `fmi_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fmi_categories`
--
ALTER TABLE `fmi_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;