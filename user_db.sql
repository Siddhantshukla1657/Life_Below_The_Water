-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 03:40 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `habitat_name` enum('Ocean Surface','Coral Reef','Deep Ocean','Freshwater') NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `full_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `habitats`
--

INSERT INTO `habitats` (`id`, `habitat_name`, `description`, `image_url`, `full_description`) VALUES
(1, 'Coral Reef', 'Colorful underwater ecosystems built by coral, teeming with life and biodiversity.', 'https://images.unsplash.com/photo-1546026423-cc4642628d2b', 'Coral reefs are vibrant underwater ecosystems constructed by living corals, which are small, colonial marine animals. These reefs are renowned for their stunning colors and diverse marine life, including fish, crustaceans, mollusks, and various other invertebrates. Coral reefs provide essential habitats and nurseries for many species, supporting approximately 25% of all known marine life. They also play a crucial role in protecting coastlines from storms and erosion. Despite their importance, coral reefs are highly sensitive to environmental changes, such as rising sea temperatures, pollution, and ocean acidification, which pose significant threats to their survival.'),
(2, 'Deep Ocean', 'The dark, high-pressure regions of the ocean, hosting unique and often bizarre creatures.', 'https://images.unsplash.com/photo-1551244072-5d12893278ab', 'The deep ocean, also known as the abyssal zone, encompasses the dark, high-pressure regions of the ocean floor, typically below 4,000 meters. This environment is characterized by extreme conditions, including near-freezing temperatures, complete darkness, and immense pressure. Despite these harsh conditions, the deep ocean is home to a unique and diverse array of life forms, many of which have adapted extraordinary survival strategies. These include bioluminescent creatures, giant squid, and various species of deep-sea fish. The deep ocean also holds vast reserves of minerals and potential energy resources, making it a subject of both scientific and economic interest.'),
(3, 'Freshwater', 'Rivers, lakes, and streams that sustain many species adapted to non-saline conditions.', 'https://media.istockphoto.com/id/922712796/photo/rocks-underwater-on-riverbed-with-clear-freshwater.jpg?s=612x612&w=0&k=20&c=0lp88lOjOyCZ6G9uUHx5RTaEIV7bfW1Q5vaDCtsVMoY=', 'Freshwater habitats include rivers, lakes, and streams, which are vital for sustaining a wide variety of plant and animal species. These ecosystems provide essential resources such as drinking water, irrigation for agriculture, and habitats for numerous aquatic organisms. Freshwater environments are characterized by their dynamic nature, with flowing waters in rivers and streams and more stable conditions in lakes and ponds. They support diverse flora and fauna, including fish, amphibians, reptiles, birds, and various aquatic plants. However, freshwater habitats are increasingly threatened by pollution, overuse, and climate change, highlighting the need for conservation efforts to protect these critical ecosystems.'),
(4, 'Ocean Surface', 'Vast open waters covering most of the Earth, home to many migratory species and diverse ecosystems.', 'https://images.unsplash.com/photo-1559494007-9f5847c49d94', 'The ocean surface covers approximately 71% of the Earth\'s surface and is home to a vast array of marine life. This expansive habitat includes the upper layers of the ocean, where sunlight penetrates, allowing for photosynthesis and supporting a rich diversity of plants and animals. The ocean surface is characterized by its dynamic nature, influenced by winds, currents, and tides. It provides essential habitats for numerous species, including plankton, fish, marine mammals, and seabirds. The ocean surface also plays a crucial role in regulating the Earth\'s climate by absorbing heat and carbon dioxide. However, it faces significant threats from pollution, overfishing, and climate change, which can disrupt the delicate balance of these ecosystems.');

-- --------------------------------------------------------

--
-- Table structure for table `initiatives`
--

CREATE TABLE `initiatives` (
  `id` int(11) NOT NULL,
  `started_by` varchar(255) NOT NULL,
  `hosted_location` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `main_description` text DEFAULT NULL,
  `initiative_type` enum('ocean_cleanup','marine_protected_areas','sustainable fishing') NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `initiatives`
--

INSERT INTO `initiatives` (`id`, `started_by`, `hosted_location`, `details`, `main_description`, `initiative_type`, `image`) VALUES
(1, 'Ocean Cleanup Project', 'Pacific Ocean', 'This initiative aims to remove plastic waste from the Pacific Ocean using advanced technologies like floating barriers and ocean cleanup systems. It involves a large-scale effort to collect and recycle plastic debris, reducing marine pollution and protecting marine life.', 'The Ocean Cleanup Project is a pioneering effort to tackle the massive problem of plastic pollution in our oceans. Founded by Boyan Slat, it has gained international attention for its innovative approach to cleaning up the Great Pacific Garbage Patch. The project involves deploying a system of floating barriers that collect plastic debris without harming marine life. The collected plastic is then recycled and used to create products, raising awareness about the issue and promoting sustainability. The initiative also conducts research on ocean pollution, providing valuable insights into the impact of plastic waste on marine ecosystems. By engaging communities worldwide, it encourages individuals to take action against pollution and supports policy changes to reduce plastic use.', 'ocean_cleanup', 'https://assets.theoceancleanup.com/app/uploads/2022/07/System03-renderings-screengrab-2-scaled.jpg'),
(2, 'World Wildlife Fund', 'Coral Reefs, Australia', 'This initiative focuses on establishing and expanding marine protected areas around Australia\'s coral reefs to preserve biodiversity and promote sustainable fishing practices.', 'The World Wildlife Fund (WWF) has launched an initiative to protect Australia\'s vibrant coral reefs by establishing and expanding marine protected areas. These protected zones provide a safe haven for marine life to thrive, supporting biodiversity and helping to maintain the health of coral ecosystems. The initiative involves working with local communities, fishermen, and government agencies to ensure sustainable fishing practices and reduce pollution. By protecting these critical ecosystems, WWF aims to preserve the beauty and ecological importance of coral reefs for future generations. The initiative also supports research and monitoring to better understand the impacts of climate change and pollution on these delicate ecosystems.', 'marine_protected_areas', 'https://imgs.search.brave.com/M4m4N-nK_4kqdAnhHOiXxuTk42wCsqLBDZyBCE5RPi8/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMucGFuZGEub3Jn/L2Fzc2V0cy9pbWFn/ZXMvZG93bmxvYWRz/L0phbjIwMTkvV1dG/X3dhbGxwYXBlcl9K/YW4yMDE5XzE0NDB4/OTAwLmpwZw'),
(3, 'Sustainable Seafood Coalition', 'North Sea', 'This initiative promotes sustainable fishing practices among fishermen in the North Sea, focusing on reducing bycatch, protecting endangered species, and ensuring the long-term viability of fish stocks.', 'The Sustainable Seafood Coalition is leading an effort to transform fishing practices in the North Sea by promoting sustainability and responsible fishing methods. The initiative works closely with fishermen, processors, and retailers to implement practices that reduce bycatch and protect endangered species. It also supports the use of fishing gear that minimizes habitat damage and promotes the recovery of depleted fish stocks. By engaging the entire seafood supply chain, the coalition aims to ensure that seafood is sourced responsibly, supporting both the environment and the livelihoods of fishing communities. The initiative also conducts workshops and training sessions to educate fishermen about the benefits of sustainable practices.', 'sustainable fishing', 'https://sustainableseafoodcoalition.org/wp-content/uploads/ssc_main-banner-image.jpeg'),
(4, 'Local Coastal Cleanup Group', 'Miami Beach', 'This initiative organizes regular beach cleanups and educates local communities about the importance of keeping coastlines free of trash to protect marine life.', 'The Local Coastal Cleanup Group has been actively working to keep Miami Beach clean and free of trash. Through regular beach cleanups, the group not only removes litter but also educates the community about the impact of pollution on marine ecosystems. The initiative involves organizing events where volunteers can participate in cleaning activities, learn about sustainable practices, and engage with local businesses to reduce plastic use. By fostering a sense of community responsibility, the group aims to create a lasting impact on environmental awareness and promote behaviors that protect marine life. The initiative also collaborates with schools to integrate environmental education into curricula.', 'ocean_cleanup', 'https://imgs.search.brave.com/ts_b0GCCNQEReHmIcYAncKvX1S3XUxwOQEYxQUjIWoQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/bGJjbGVhbnVwLmNv/bS9pbWFnZXMvbGJj/bGVhbnVwLXNjaGVk/dWxlLmpwZw'),
(5, 'Marine Conservation Institute', 'California Coast', 'This initiative seeks to expand marine reserves along the California coast to safeguard marine biodiversity and support the recovery of depleted fish populations.', 'The Marine Conservation Institute is spearheading an effort to expand marine reserves along the California coast. These protected areas provide a safe haven for marine life to flourish, supporting biodiversity and helping to replenish depleted fish stocks. The initiative involves conducting scientific research to identify critical habitats and working with policymakers to establish new reserves. By protecting these ecosystems, the institute aims to ensure the long-term health of California\'s marine environment and support sustainable fishing practices. The initiative also engages local communities in conservation efforts, promoting awareness about the importance of marine reserves.', 'marine_protected_areas', 'https://www.americanprogress.org/wp-content/uploads/sites/2/2019/05/GettyImages-526331225.jpg?w=1040'),
(6, 'Fishing Gear Innovators', 'Baltic Sea', 'This initiative develops and promotes the use of sustainable fishing gear that reduces bycatch and minimizes habitat damage in the Baltic Sea.', 'Fishing Gear Innovators are leading a project to develop and promote sustainable fishing gear in the Baltic Sea. The initiative focuses on designing nets and lines that reduce bycatch and minimize damage to marine habitats. By working with fishermen and manufacturers, the group aims to make sustainable gear the standard in the industry. This not only helps protect endangered species but also supports the long-term viability of fish stocks. The initiative also conducts workshops to educate fishermen about the benefits of using sustainable gear and collaborates with policymakers to implement regulations supporting its use.', 'sustainable fishing', 'https://imgs.search.brave.com/UM-eRz_Ih9ZyDvJqFbyyHoHpZtdrv8T5ffkjTCWsF14/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/c2VhZmlzaC5vcmcv/bWVkaWEvYTVlYnBx/MWsvbXVsdGktcmln/LXRyYXdsLXNvbGUt/dHJpcGxlLXJpZy5q/cGc_dj0xZGFkZjRh/Y2ExMWY3ODA'),
(7, 'Community Volunteers', 'Hawaii', 'This initiative involves community-led efforts to clean up beaches and coastal areas in Hawaii, promoting environmental stewardship and community engagement.', 'In Hawaii, a group of community volunteers has come together to lead an initiative focused on cleaning up beaches and coastal areas. Through regular cleanups and educational events, the group aims to foster a sense of community responsibility for environmental stewardship. The initiative involves engaging local schools, businesses, and residents in cleanup activities and promoting sustainable practices to reduce waste. By working together, the community seeks to protect Hawaii\'s beautiful natural landscapes and marine ecosystems for future generations. The initiative also partners with local organizations to support environmental education programs.', 'ocean_cleanup', 'https://media.istockphoto.com/id/986900214/photo/volunteers-cleaning-park.jpg?s=1024x1024&w=is&k=20&c=3OY1NUW1pay6AyYDBJ-scvdDZeqTc1JPeAz4IU5lABc='),
(8, 'Marine Research Institute', 'Mediterranean Sea', 'This initiative conducts research on marine protected areas in the Mediterranean Sea to understand their effectiveness in conserving biodiversity and supporting sustainable fishing.', 'The Marine Research Institute is conducting a comprehensive study on marine protected areas in the Mediterranean Sea. The initiative aims to assess the effectiveness of these protected zones in conserving marine biodiversity and supporting sustainable fishing practices. By analyzing data on fish populations, habitat health, and ecosystem services, researchers can provide insights into how these areas contribute to the overall health of the Mediterranean ecosystem. The findings will inform policy decisions and conservation strategies, helping to ensure the long-term protection of marine life in the region. The initiative also collaborates with local communities to integrate research findings into management practices.', 'marine_protected_areas', 'https://www.mio.osupytheas.fr/wp-content/uploads/2024/02/logo-mio-fr.png'),
(9, 'Sustainable Seafood Alliance', 'Atlantic Ocean', 'This initiative promotes sustainable seafood by developing certification programs for fisheries that adhere to strict environmental and social standards.', 'The Sustainable Seafood Alliance is working to promote sustainable seafood practices by developing a certification program for fisheries in the Atlantic Ocean. The program recognizes fisheries that adhere to strict environmental and social standards, ensuring that seafood is caught responsibly and with minimal impact on marine ecosystems. By engaging consumers, retailers, and fishermen, the alliance aims to create a market-driven incentive for sustainable fishing practices. This not only supports the health of marine ecosystems but also helps maintain the livelihoods of fishing communities. The initiative also conducts audits to ensure compliance with certification standards.', 'sustainable fishing', 'https://cdn.pixabay.com/photo/2015/09/09/20/36/fish-933187_1280.jpg'),
(10, 'Environmental Education Group', 'New York Coast', 'This initiative combines coastal cleanup efforts with educational programs to raise awareness about marine pollution and promote sustainable behaviors among coastal communities.', 'The Environmental Education Group has launched an initiative that combines coastal cleanup activities with educational programs along the New York coast. The initiative aims to not only remove trash from beaches but also educate the community about the causes and consequences of marine pollution. Through workshops and events, participants learn about sustainable practices, such as reducing plastic use and properly disposing of waste. By engaging schools and local businesses, the group fosters a culture of environmental responsibility, encouraging individuals to take action against pollution. The initiative also develops educational materials for schools to integrate environmental education into curricula.', 'ocean_cleanup', 'https://www.mdpi.com/sustainability/sustainability-13-12041/article_deploy/html/images/sustainability-13-12041-g003-550.jpg'),
(11, 'Marine Conservation Society', 'Caribbean Sea', 'This initiative focuses on managing and maintaining marine reserves in the Caribbean Sea to ensure their effectiveness in conserving marine biodiversity.', 'The Marine Conservation Society is working to manage and maintain marine reserves in the Caribbean Sea. The initiative involves monitoring marine life, enforcing protection laws, and engaging local communities in conservation efforts. By ensuring that these protected areas are effectively managed, the society aims to safeguard the rich biodiversity of the Caribbean Sea and support sustainable fishing practices. The initiative also conducts research to better understand the impacts of climate change on marine ecosystems and develops strategies to mitigate these effects.', 'marine_protected_areas', 'https://imgs.search.brave.com/Rw4on0DlVOKlJd6SpYlMjlzLkBFQvKQEPldGWPbj4IM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvZW4vdGh1bWIv/Yy9jMi9NQ1NfTG9n/b19GdWxsLnBuZy81/MTJweC1NQ1NfTG9n/b19GdWxsLnBuZw'),
(12, 'Fishing Technology Innovators', 'Indian Ocean', 'This initiative develops and promotes innovative fishing technologies that reduce bycatch and support sustainable fishing practices in the Indian Ocean.', 'Fishing Technology Innovators are developing and promoting innovative fishing technologies designed to reduce bycatch and support sustainable fishing practices in the Indian Ocean. The initiative focuses on designing gear that minimizes the catch of non-target species and reduces habitat damage. By collaborating with fishermen and manufacturers, the group aims to make these technologies accessible and affordable for the fishing industry. This not only helps protect marine ecosystems but also supports the long-term viability of fish stocks. The initiative also conducts training sessions to educate fishermen about the benefits and proper use of these technologies.', 'sustainable fishing', 'https://cdn.pixabay.com/photo/2021/06/17/04/42/man-6342665_1280.jpg'),
(13, 'Community Engagement Initiative', 'South Africa', 'This initiative engages local communities in South Africa in ocean cleanup efforts, promoting environmental awareness and community-led conservation.', 'The Community Engagement Initiative in South Africa is working to engage local communities in ocean cleanup efforts. Through community-led cleanups and educational events, the initiative aims to foster a sense of responsibility for environmental stewardship. By involving schools, businesses, and residents in cleanup activities, the group promotes sustainable practices and raises awareness about the impact of pollution on marine ecosystems. The initiative also partners with local organizations to support environmental education programs and develop community-led conservation projects.', 'ocean_cleanup', 'https://images.squarespace-cdn.com/content/v1/624b15eaed90eb4638ead49d/1681925135717-AQW4WHQONVDEHBWS9IES/header_sa_7.jpg'),
(14, 'Marine Biodiversity Project', 'Red Sea', 'This initiative focuses on conserving marine biodiversity in the Red Sea by protecting critical habitats and promoting sustainable fishing practices.', 'The Marine Biodiversity Project is dedicated to conserving marine biodiversity in the Red Sea. The initiative involves protecting critical habitats such as coral reefs and seagrass beds, which are essential for maintaining the health of marine ecosystems. By promoting sustainable fishing practices and engaging local communities in conservation efforts, the project aims to safeguard the rich biodiversity of the Red Sea. The initiative also conducts research to better understand the impacts of human activities on marine ecosystems and develops strategies to mitigate these effects.', 'marine_protected_areas', 'https://cdn.pixabay.com/photo/2013/11/01/11/13/dolphin-203875_1280.jpg'),
(15, 'Small-Scale Fisheries Alliance', 'Southeast Asia', 'This initiative develops certification programs for small-scale fisheries in Southeast Asia to promote sustainable fishing practices and improve market access for responsibly caught seafood.', 'The Small-Scale Fisheries Alliance is working to promote sustainable fishing practices among small-scale fisheries in Southeast Asia. The initiative involves developing certification programs that recognize fisheries adhering to strict environmental and social standards. By providing small-scale fisheries with access to these certification programs, the alliance aims to improve their market access and support their livelihoods. This not only helps maintain the health of marine ecosystems but also ensures that fishing communities benefit from sustainable practices. The initiative also conducts training sessions to educate fishermen about the benefits and requirements of certification.', 'sustainable fishing', 'https://cdn.pixabay.com/photo/2017/07/13/19/41/hvidovre-2501661_1280.jpg'),
(16, 'Coastal Restoration Project', 'Gulf of Mexico', 'This initiative focuses on restoring coastal ecosystems in the Gulf of Mexico, including mangroves and salt marshes, to enhance biodiversity and protect against climate change impacts.', 'The Coastal Restoration Project is working to restore coastal ecosystems in the Gulf of Mexico, focusing on mangroves and salt marshes. These ecosystems are crucial for supporting biodiversity, protecting shorelines from erosion, and mitigating the impacts of climate change. By engaging local communities and partnering with conservation organizations, the project aims to replant and restore these critical habitats. The initiative also conducts research to better understand the ecological benefits of restoration and develops strategies to ensure the long-term health of restored ecosystems.', 'ocean_cleanup', 'https://cdn.pixabay.com/photo/2020/05/19/13/25/gower-5190799_1280.jpg'),
(17, 'Marine Protected Area Network Initiative', 'Pacific Islands', 'This initiative aims to establish a network of marine protected areas across the Pacific Islands to safeguard marine biodiversity and support sustainable fishing practices.', 'The Marine Protected Area Network Initiative is working to establish a network of marine protected areas across the Pacific Islands. This network will provide a comprehensive framework for conserving marine biodiversity and supporting sustainable fishing practices. By collaborating with local governments and communities, the initiative aims to ensure that these protected areas are effectively managed and contribute to the long-term health of Pacific Island ecosystems. The initiative also conducts research to identify critical habitats and develops strategies to engage local communities in conservation efforts.', 'marine_protected_areas', 'https://imgs.search.brave.com/5iZpcgYeX4jSqktelnWb7NU60YwKypnZcUihhCrQNkc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tYXJp/bmVwcm90ZWN0ZWRh/cmVhcy5ub2FhLmdv/di9tZWRpYS9pbWcv/MjAyMzA1MjQtcGxh/bm5lcnMtZ3VpZGUt/NDAwLmpwZw'),
(18, 'Deep-Sea Fisheries Alliance', 'Deep Sea', 'This initiative promotes sustainable fishing practices in deep-sea fisheries, focusing on reducing bycatch and protecting vulnerable ecosystems.', 'The Deep-Sea Fisheries Alliance is leading an effort to promote sustainable fishing practices in deep-sea fisheries. The initiative involves developing and implementing practices that reduce bycatch and protect vulnerable deep-sea ecosystems. By working with fishermen, policymakers, and conservation organizations, the alliance aims to ensure that deep-sea fishing is conducted responsibly, supporting both the health of marine ecosystems and the livelihoods of fishing communities. The initiative also conducts research to better understand the impacts of deep-sea fishing on marine life and develops strategies to mitigate these effects.', 'sustainable fishing', 'https://cdn.pixabay.com/photo/2014/07/31/16/15/ship-406420_1280.jpg'),
(19, 'Community Marine Conservation Group', 'Philippines', 'This initiative engages local communities in the Philippines in marine conservation efforts, promoting sustainable fishing practices and protecting marine biodiversity.', 'The Community Marine Conservation Group in the Philippines is working to engage local communities in marine conservation efforts. Through community-led initiatives, the group promotes sustainable fishing practices and protects marine biodiversity. By involving fishermen, schools, and local businesses in conservation activities, the initiative fosters a sense of community responsibility for environmental stewardship. The group also conducts educational programs to raise awareness about the importance of marine conservation and supports policy changes to protect marine ecosystems.', 'marine_protected_areas', 'https://cdn.pixabay.com/photo/2024/08/02/09/01/barracuda-8939250_1280.jpg'),
(20, 'Ocean Cleanup Technology Developers', 'North Atlantic', 'This initiative develops innovative technologies to remove plastic waste from the North Atlantic, focusing on efficient and environmentally friendly solutions.', 'Ocean Cleanup Technology Developers are working on an initiative to develop innovative technologies for removing plastic waste from the North Atlantic. The focus is on creating efficient and environmentally friendly solutions that can effectively collect and recycle plastic debris without harming marine life. By collaborating with engineers, researchers, and conservationists, the initiative aims to provide scalable solutions to the problem of ocean pollution. The technologies developed will not only help clean up existing pollution but also serve as models for future cleanup efforts worldwide. The initiative also conducts research to better understand the impacts of plastic pollution on marine ecosystems.', 'ocean_cleanup', 'https://imgs.search.brave.com/6v2NRnvxxkmeZW170o6W2t5VYEtQNGc1I8muou0jxkQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9icml0/aXNoc2VhZmlzaGlu/Zy5jby51ay93cC1j/b250ZW50L3VwbG9h/ZHMvMjAyMi8wNC9S/Uy1PY2Vhbi1DbGVh/bnVwLVNoaXAtQy1j/dWx0aXZhcjQxMy5q/cGc'),
(21, ' Deep Ocean Biodiversity Conservation Initiative', 'Atlantic and Pacific Oceans', 'This initiative focuses on protecting biodiversity in deep-sea ecosystems through research and policy development.', 'The Deep Ocean Biodiversity Conservation Initiative aims to safeguard the rich and fragile ecosystems of the deep ocean. By conducting extensive research on species such as the vampire squid and their ecological roles, the initiative informs global conservation policies. It collaborates with international organizations to address threats like deep-sea mining and climate change while promoting sustainable practices. The initiative also raises awareness about the importance of preserving these habitats for future generations.', 'marine_protected_areas', 'https://deep-sea-conservation.org/wp-content/uploads/2024/01/FK200308-HydroidScreenShot-20200316.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `last_viewed`
--

CREATE TABLE `last_viewed` (
  `loginId` int(11) NOT NULL,
  `species_id` int(11) DEFAULT NULL,
  `viewed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `last_viewed`
--

INSERT INTO `last_viewed` (`loginId`, `species_id`, `viewed_at`) VALUES
(1, 16, '2025-04-11 09:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `marine_animals`
--

CREATE TABLE `marine_animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `scientific_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `habitat` enum('Ocean','Coral Reef','Deep Ocean','Freshwater') DEFAULT NULL,
  `diet` varchar(255) DEFAULT NULL,
  `conservation_status` varchar(100) DEFAULT NULL,
  `interesting_facts` text DEFAULT NULL,
  `related_species` text DEFAULT NULL,
  `top_image_url` text DEFAULT NULL,
  `bottom_image_url` text DEFAULT NULL,
  `video_url` text DEFAULT NULL,
  `final_description` text DEFAULT NULL,
  `vulnerability` enum('Low','Medium','High') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marine_animals`
--

INSERT INTO `marine_animals` (`id`, `name`, `scientific_name`, `description`, `habitat`, `diet`, `conservation_status`, `interesting_facts`, `related_species`, `top_image_url`, `bottom_image_url`, `video_url`, `final_description`, `vulnerability`) VALUES
(1, 'Axolotl', 'Ambystoma mexicanum', 'A neotenic aquatic salamander with external gills, native to Mexico.', 'Freshwater', 'In the Wild: They feed on small fish, worms, and insects. In Captivity: Their diet is carefully managed and can include pellets specifically formulated for axolotls, as well as live prey such as worms and small aquatic insects.', 'Endangered', 'Neoteny: Axolotls exhibit neoteny, retaining their juvenile features, such as external gills, throughout their lives. Regeneration: They have an extraordinary ability to regenerate lost body parts, including limbs, portions of the spinal cord, and even parts of the heart and brain. Lifespan: Axolotls can live up to 15 years in captivity, although their lifespan in the wild is often shorter due to environmental challenges. Color Variations: They come in various color morphs, including wild-type (brown/green), albino (pink with red gills), and melanoid (black). Critically Endangered: Despite being relatively common in the pet trade, axolotls are critically endangered in the wild due to habitat loss and pollution. Research Model: Their unique regenerative abilities make them a valuable model organism in scientific research, particularly in the study of tissue regeneration and wound healing.', 'Tiger Salamander (Ambystoma tigrinum): One of the most widespread and well-known species in the genus, found throughout North America', 'https://c402277.ssl.cf1.rackcdn.com/photos/20852/images/magazine_medium/axolotl_WWsummer2021.jpg?1618758847', 'https://i.imgur.com/GL7yJsq.gif', 'https://www.youtube.com/embed/bFkIG9S2Mmg?si=_o7VuPisi03-u8e3', 'Axolotls are neotenic salamanders, not fish, known for retaining their larval features like feathery external gills and a wide head. Native to freshwater habitats near Mexico City, they feed on small aquatic animals. Axolotls possess remarkable regenerative abilities, making them important in scientific research. However, they are critically endangered due to habitat destruction and pollution. Conservation efforts are crucial for their survival.', 'Low'),
(2, 'Great White Shark', 'Carcharodon carcharias', 'A large and powerful predatory shark found in oceans worldwide.', 'Ocean', 'Carnivorous; primarily feeds on seals, fish, and occasionally smaller sharks.', 'Vulnerable', 'Great white sharks can detect a drop of blood in 25 gallons of water. They are capable of burst speeds and have one of the most powerful bites in the animal kingdom.', 'Bull Shark, Tiger Shark', 'https://images.theconversation.com/files/466612/original/file-20220601-48284-ipylp2.jpg?ixlib=rb-4.1.0&q=20&auto=format&w=320&fit=clip&dpr=2&usm=12&cs=strip', 'https://media1.giphy.com/media/fML0o38F1hccuWldOa/giphy.gif?cid=6c09b9528e3bwzfpf9nostao9aexfur5h5waomdhj22qp7bw&ep=v1_gifs_search&rid=giphy.gif&ct=g', 'https://www.youtube.com/embed/DBy_ZdIs_CQ?si=bLrBrpE0kP_6zMGG', 'The Great White Shark is one of the most iconic marine predators, known for its massive size, serrated teeth, and acute sensory systems. Found in coastal and offshore waters across the globe, these apex predators can grow up to 6 meters in length and weigh over 2,000 kilograms. Their powerful bodies and streamlined shapes allow them to swim at impressive speeds, making them efficient hunters. Great Whites have a keen sense of smell, electroreception through the ampullae of Lorenzini, and excellent vision that helps them locate prey like seals, dolphins, and large fish. Despite their fearsome reputation, attacks on humans are extremely rare and usually result from mistaken identity.', 'High'),
(3, 'Clownfish', 'Amphiprioninae', 'Small, brightly colored fish often found living among anemones.', 'Coral Reef', 'Omnivorous; feeds on algae, plankton, and small invertebrates.', 'Least Concern', 'Clownfish can change gender during their lifetime and live in a mutualistic relationship with sea anemones, which protect them from predators.', 'Damselfish, Anthias', 'https://images.newscientist.com/wp-content/uploads/2018/08/23130240/by0ndk.jpg', 'https://media3.giphy.com/media/Y4K9JjSigTV1FkgiNE/giphy.gif?cid=6c09b952i029jp50itoxh6nq3a86zpfdupyio4bujl6cyg6b&ep=v1_gifs_search&rid=giphy.gif&ct=g', 'https://www.youtube.com/embed/G4YWKrong_c?si=z853gr0IM45k3U7k', 'Clownfish, famous for their vivid orange coloration with bold white stripes, are small reef fish that form mutualistic relationships with sea anemones. These colorful fish are native to the warm shallow waters of the Indian and Pacific Oceans, including the Great Barrier Reef. One of their most unique biological traits is their immunity to the venomous stings of anemones, which they use as both home and protection. Clownfish live in hierarchical groups and exhibit sequential hermaphroditism, meaning individuals can change sex from male to female when needed for reproductive balance. Their symbiosis with sea anemones benefits both parties—the clownfish gains protection, while the anemone gets cleaned and receives improved water circulation.', 'Low'),
(4, 'Blue Tang', 'Paracanthurus hepatus', 'A vibrant blue reef fish popular in saltwater aquariums.', 'Coral Reef', 'Herbivorous; primarily feeds on algae.', 'Least Concern', 'Blue tangs are recognized for their bright blue coloration and yellow tail, making them popular in marine aquariums.', 'Surgeonfish, Parrotfish', 'https://tse2.mm.bing.net/th/id/OIP._KGQZ-bJF4g1E2ybHiSLtwHaFM?rs=1&pid=ImgDetMain', 'https://media.giphy.com/media/26FKWlExAnsWOKSKk/giphy.gif', 'https://www.youtube.com/embed/msPP6FCN-RE?si=ViQyQmC7yKoGaRs4', 'Blue tangs are bright blue reef fish with yellow tails, made famous as \'Dory\' in Finding Nemo. These disc-shaped fish inhabit coral reefs in the Indo-Pacific region where they feed primarily on algae. They play an important ecological role by helping control algae growth on reefs. Blue tangs can change color slightly as they age or when stressed, and they possess a sharp spine near their tail that can be extended for defense. They are social creatures often seen swimming in schools during daylight hours, providing a striking visual display against the reef backdrop.', 'Medium'),
(5, 'Leatherback Sea Turtle', 'Dermochelys coriacea', 'The largest living turtle, lacking a bony shell.', 'Ocean', 'Feeds primarily on jellyfish and other soft-bodied organisms.', 'Critically Endangered', 'Leatherback turtles have a unique, flexible shell and can dive to great depths, making them uniquely adapted to the open ocean.', 'Green Sea Turtle, Loggerhead Turtle', 'https://naturecanada.ca/wp-content/uploads/2019/02/Leatherback-Turtle-%C2%A9-Jason-Isley-scubazoo-1024x684.jpg', 'https://media4.giphy.com/media/LMVkZXubrWzcaZNq10/giphy.gif', 'https://www.youtube.com/embed/DkSStkrwog4?si=QFIEDodu2Tsor5_q', 'The Leatherback Sea Turtle is the largest and most migratory of all sea turtles, distinguished by its lack of a bony shell and instead covered by a leathery, flexible carapace. It can grow over 2 meters in length and weigh more than 900 kilograms. These turtles are adapted for deep diving and long-distance oceanic travel, often crossing entire oceans to reach nesting beaches. Leatherbacks feed almost exclusively on jellyfish and help control jellyfish populations. Their decline is linked to habitat destruction, climate change, plastic ingestion, and fisheries bycatch, putting them in critical danger in many regions.', 'High'),
(6, 'Manta Ray', 'Mobula birostris', 'Large, graceful rays with wing-like pectoral fins.', 'Ocean', 'Planktivorous; feeds on plankton filtered from the water column.', 'Vulnerable', 'Manta rays can have a wingspan of up to 7 meters and are known for their acrobatic leaps out of the water.', 'Devil Ray, Eagle Ray', 'https://www.hawaiimagazine.com/content/uploads/2024/09/c/c/20240817-manta-ray-gettyimages-159195037.jpg', 'https://media1.giphy.com/media/tGAMlYun7ScLe/giphy.gif?cid=6c09b9524ydo7irr4g0cinmkjol31i2n9yw4samu224o4ts7&ep=v1_gifs_search&rid=giphy.gif&ct=g', 'https://www.youtube.com/embed/eYkZCl_nsAI?si=tQszDk5fYdR4idIH', 'Manta rays are among the largest rays in the ocean, with wingspans reaching up to 7 meters. These graceful filter feeders glide through the water using their large pectoral fins in a motion resembling flight. Unlike stingrays, mantas lack a stinging barb and are harmless to humans. They feed by swimming with their mouths open, filtering plankton and small fish with specialized gill plates. Manta rays are known for their intelligence, having one of the largest brain-to-body ratios among fish. They\'re often seen performing acrobatic leaps above the water surface and engaging in social behavior. These majestic creatures face threats from fishing pressure, particularly for their gill plates used in traditional medicine.', 'Medium'),
(7, 'Emperor Penguin', 'Aptenodytes forsteri', 'A large penguin species that breeds on Antarctic ice.', 'Ocean', 'Feeds on fish, squid, and krill.', 'Near Threatened', 'Emperor penguins breed during the Antarctic winter and are renowned for their long, treacherous journeys to reach breeding grounds.', 'King Penguin, Adelie Penguin', 'https://cff2.earth.com/uploads/2022/10/27063339/Emperor-penguin-scaled.jpg', 'https://31.media.tumblr.com/1d68f308c1419876a85a54ee55c6810a/tumblr_nefgv7Fv9g1u2cdx3o1_500.gif', 'https://www.youtube.com/embed/MfstYSUscBc?si=At-26gmzvOfQnQDN', 'Emperor penguins are the tallest and heaviest of all penguin species, standing up to 122 cm tall and weighing up to 45 kg. They are known for their remarkable breeding cycle, which takes place during the harsh Antarctic winter. Males incubate a single egg on their feet for about two months while females return to the sea to feed. Emperor penguins have multiple adaptations for extreme cold, including several layers of scale-like feathers and high concentrations of body fat. They form large colonies and huddle together to share warmth, rotating positions so each bird gets a turn in the warmer interior. These extraordinary birds can dive to depths over 500 meters and hold their breath for up to 20 minutes while hunting fish, squid, and krill.', 'Low'),
(8, 'Coral Reef Fish', 'Various species', 'A diverse group of colorful fish inhabiting coral reefs.', 'Coral Reef', 'Mostly omnivorous; feeding on algae, plankton, and small invertebrates.', 'Least Concern', 'Coral reef fish contribute to the dynamic ecosystem of coral reefs by participating in nutrient recycling and algae control.', 'Reef Shark, Parrotfish', 'https://static.vecteezy.com/system/resources/previews/026/705/276/large_2x/underwater-view-with-fish-corals-reef-and-beautiful-diversity-of-marine-life-photo.jpg', 'https://tse1.mm.bing.net/th/id/OIP.mb6Ubfh3kPQoIWDxHicHogAAAA?rs=1&pid=ImgDetMain', 'https://www.youtube.com/embed/SnBWOe13QlQ?si=q_A_j3Ow_DaEXQwQ', 'Coral reef fish comprise one of the most diverse and colorful assemblages of vertebrates on Earth. These fish species have evolved in close relationship with coral reef ecosystems, developing specialized adaptations for feeding, reproduction, and survival. They exhibit an extraordinary range of shapes, sizes, and colors, from the tiny gobies to larger groupers and parrotfish. Many species have specific ecological roles, such as herbivores that control algae growth, cleaners that remove parasites from other fish, and predators that maintain population balances. The intricate relationships between these fish species contribute to the complex and dynamic nature of coral reef ecosystems, which are among the most productive and diverse habitats on the planet.', 'Low'),
(9, 'Seahorse', 'Hippocampus sp.', 'A unique fish with a horse-like head and curled tail.', 'Coral Reef', 'Feeds on small crustaceans and plankton.', 'Vulnerable', 'Seahorses are one of the few species where the male is responsible for carrying the offspring, making their reproductive cycle truly unique.', 'Pipefish, Dragonet', 'https://tse2.mm.bing.net/th/id/OIP.bge7zQMTT_2q_g7bGVk3YwHaHa?rs=1&pid=ImgDetMain', 'https://tse2.mm.bing.net/th/id/OIP.CPrJRxyencNDXrrAV0Xu8QAAAA?rs=1&pid=ImgDetMain', 'https://www.youtube.com/embed/ENaBRWLCSOQ?si=eYlQame2BzTscvPh', 'Seahorses are unique marine fish characterized by their horse-like head, prehensile tail, and upright swimming posture. Unlike most fish, seahorses have a specialized anatomy with an exoskeleton of bony plates, no caudal fin, and a corona of spines on their head. Their most extraordinary feature is their reproductive strategy—males have a specialized brood pouch where females deposit eggs, and it\'s the male who becomes \'pregnant\' and eventually gives birth to fully-formed young seahorses. These slow-moving creatures use camouflage to blend with their surroundings and feed by sucking small crustaceans through their tubular snouts. They form monogamous pairs, with many species maintaining long-term bonds and performing daily greeting rituals to strengthen their pair bond.', 'Medium'),
(10, 'Octopus', 'Octopoda', 'An intelligent, eight-armed marine mollusk.', 'Deep Ocean', 'Carnivorous; primarily feeds on crustaceans and small fish.', 'Least Concern', 'Octopuses can squeeze through tiny gaps and are known for their complex behaviors and short lifespans.', 'Squid, Cuttlefish', 'https://fthmb.tqn.com/-tQ-2g4SZONLOBl8oj_LBpPiJfM=/2250x1500/filters:fill(auto,1)/182147638-56a006d35f9b58eba4ae8c3e.jpg', 'https://media4.giphy.com/media/26n6XsLU5UQ63c7V6/giphy.gif', 'https://www.youtube.com/embed/oSyEZAm8nb8?si=RSAfdtosqW3LwOIG', 'Octopuses are highly intelligent cephalopods with soft bodies, eight arms lined with suckers, and complex nervous systems. They\'re masters of camouflage, able to change color, texture, and shape to match their surroundings almost instantaneously. Lacking a skeleton, they can squeeze through incredibly small spaces—any opening large enough for their beak. Octopuses show remarkable problem-solving abilities, tool use, and even playful behavior. Each arm contains its own neural connections that can operate somewhat independently. Most species live solitary lives in dens they create from rocks and shells, hunting primarily at night for crustaceans and mollusks. Despite their intelligence, most octopuses have short lifespans of only 1-2 years, with females typically dying shortly after their eggs hatch.', 'Medium'),
(11, 'Giant Squid', 'Architeuthis dux', 'A colossal deep-sea cephalopod with large eyes.', 'Deep Ocean', 'Predatory; feeds on fish and other squids.', 'Data Deficient', 'Giant Squids are rarely seen alive and are primarily known from carcasses and deep-sea footage. Their size and behavior are still largely unknown.', 'Colossal Squid', 'https://i.natgeofe.com/n/bdf08d49-5eec-4ffe-89a1-fafc72d8d718/giant-squid_3x4.jpg', 'https://th.bing.com/th/id/R.dd79553985d84663e2fdd876d42b903b?rik=ylyPVF%2fJzpvaQw&riu=http%3a%2f%2fnewsbitesmedia.com%2fimages%2fgalleries%2f46fa711baea53d53-pin-deep-ocean-life-desktop-wallpaper-on-pinterest.gif&ehk=dxOk9L0M7eXviYwNsxlt8bEfkXMNFF4ZoXRqJ4EQDcU%3d&risl=&pid=ImgRaw&r=0', 'https://www.youtube.com/embed/FBLNLJRE71o?si=TvoRncMC4zNWxslk', 'Giant squids are elusive deep-sea cephalopods that can reach enormous sizes—up to 13 meters for females, making them among the largest invertebrates on Earth. They possess the largest eyes in the animal kingdom, measuring up to 25 cm in diameter, which help them detect light in the deep ocean. These mysterious creatures have eight arms and two longer feeding tentacles used to seize prey from a distance. Their biology includes a parrot-like beak, three hearts, and blue blood containing copper-based hemocyanin rather than iron-based hemoglobin. Despite their legendary status, giant squids were not photographed alive in their natural habitat until 2004, and much about their behavior remains unknown. They are believed to feed primarily on deep-sea fish and other squid species, while being prey themselves for sperm whales.', 'High'),
(12, 'Whale Shark', 'Rhincodon typus', 'The largest fish in the world, a filter feeder.', 'Ocean', 'Planktivorous; primarily feeds on plankton and small fish.', 'Endangered', 'Whale Sharks have a unique spot pattern that can be used to identify individuals, much like fingerprints.', 'Basking Shark, Oceanic Whitetip Shark', 'https://tse1.mm.bing.net/th/id/OIP.vCnSurtISu_q4z-cdetqbwAAAA?rs=1&pid=ImgDetMain', 'https://64.media.tumblr.com/fee179bc0fad73efb581379984ddf3bc/tumblr_nm44jv8MOv1tfz725o2_400.gif', 'https://www.youtube.com/embed/JyJJTf2rVd4?si=6H_QxtFMZH1Zr6f-', 'The whale shark is the largest living fish species, reaching lengths of up to 12 meters. Despite its imposing size, it\'s a gentle filter feeder that primarily consumes plankton and small fish. These massive sharks have distinctive checkerboard patterns of light spots and stripes on their dark blue-gray backs, which are unique to each individual like fingerprints. They have wide, flattened heads with nearly 3,000 tiny teeth that aren\'t used for feeding. Instead, they filter feed by opening their large mouths and either swimming forward or actively sucking in water. Whale sharks are highly migratory, traveling thousands of kilometers across tropical oceans, often following seasonal food abundances. Despite their importance as charismatic megafauna, many aspects of their reproduction and life cycle remain mysterious to scientists.', 'Low'),
(13, 'Barracuda', 'Sphyraena', 'A predatory ray-finned fish with sharp teeth.', 'Ocean', 'Carnivorous; feeds on smaller fish and cephalopods.', 'Least Concern', 'Barracudas are known for their lightning speed and can often be seen chasing schools of fish in clear, blue waters.', 'Bonito, Mackerel', 'https://tse2.mm.bing.net/th/id/OIP.BZIpVzOQoe6fDyRN_gkvUAHaEK?rs=1&pid=ImgDetMain', 'https://cdn.myshoptet.com/usr/www.mapcards.cz/user/documents/upload/MCA02%20BARRACUDA%20GIF.gif', 'https://www.youtube.com/embed/K8h-ciNw09I?si=N-1jcK2u1gUEn8rI', 'Barracudas are sleek, predatory fish characterized by their elongated bodies, pointed heads, and fearsome-looking teeth. These powerful swimmers can reach speeds of up to 40 km/h, making them effective ambush predators. Most species have a distinctive pattern of dark bars or spots on silvery sides that provides camouflage in open water. Barracudas typically hunt by sight, relying on their excellent vision to spot prey before launching rapid attacks. Young barracudas often gather in schools for protection, while adults tend to be solitary hunters. Despite their intimidating appearance and occasional curiosity toward divers, unprovoked attacks on humans are rare. They primarily feed on smaller fish and are important predators in reef ecosystems, helping to maintain the health and balance of fish populations.', 'Medium'),
(14, 'Mandarinfish', 'Synchiropus splendidus', 'A small, vibrantly colored reef fish.', 'Coral Reef', 'Planktivorous; feeds on small planktonic organisms.', 'Least Concern', 'Mandarinfish are popular in aquariums due to their unique and vivid color patterns, though they can be difficult to keep in captivity.', 'Dragonet, Coral Trout', 'https://as1.ftcdn.net/v2/jpg/05/59/94/90/1000_F_559949032_unudNVi2N0kMETxEK2HNeXjDyIDoiDuj.jpg', 'https://www.thesprucepets.com/thmb/WVcKWGkQhpvQbxQ3YyPGOd4ALPA=/4134x2756/filters:fill(auto,1)/portrait-of-mandarin-fish-synchiropus-splendidus--banda-neira-island--indonesia-892114852-5ac6bd95875db900373d0afd.jpg', 'https://www.youtube.com/embed/KivINH0ka_A?si=2TB3K1uj4VgEq6Y-', 'Mandarinfish are small, brightly colored marine fish native to the Pacific, renowned for their dazzling patterns of blue, orange, and green. Unlike most fish that have scales, mandarinfish have a slimy coating that contains a toxin making them unpalatable to predators. They are selective feeders, primarily consuming small crustaceans and other invertebrates from the reef substrate. Mandarinfish are particularly known for their elaborate mating rituals, which occur at dusk when pairs rise slightly above the reef to release eggs and sperm into the water. They\'re shy creatures that spend most of their time hiding among coral and rocks, emerging mainly at feeding time. Their vibrant coloration and interesting behavior make them popular in the aquarium trade, though they\'re challenging to keep due to their specialized diet and habitat requirements.', 'Low'),
(15, 'Lionfish', 'Pterois volitans', 'A venomous fish with distinctive spiky fins.', 'Coral Reef', 'Carnivorous; feeds on small fish and invertebrates.', 'Invasive', 'Lionfish are highly venomous and reproduce rapidly, making them one of the most problematic invasive species in the Atlantic Ocean.', 'Scorpionfish, Stonefish', 'https://www.gannett-cdn.com/-mm-/ae5c107579c6146502448b9776e54d2d092ef818/c=0-203-2869-1824/local/-/media/2015/02/16/USATODAY/USATODAY/635596937332890704-021615FNP-ENVIRONMENT.jpg?width=3200&height=1680&fit=crop', 'https://img.soogif.com/ukhzck4VQZkqZclWSinSfJH1EmDz7LJK.gif', 'https://www.youtube.com/embed/ZJWZgWbGhvw?si=U9EKgzmsQC38KEA9', 'Lionfish are striking predatory fish characterized by their distinctive zebra-striped bodies and fan-like pectoral fins adorned with venomous spines. Native to the Indo-Pacific, they\'ve become infamous as highly successful invasive species in the Atlantic Ocean and Caribbean Sea. Their beautiful but dangerous appearance serves as a warning—their spines contain a potent neurotoxin that can cause extreme pain, respiratory distress, and even paralysis in humans. Lionfish are voracious predators with enormous appetites, capable of consuming prey up to half their body size. They use their large pectoral fins to corner prey before swallowing them whole. Their reproductive capacity is remarkable, with females capable of releasing up to 2 million eggs annually. Control efforts in invaded regions include promoting them as food fish, as their meat is actually quite delicious and safe to eat once the venomous spines are removed.', 'High'),
(16, 'Stingray', 'Dasyatis pastinaca', 'A flat-bodied ray with venomous barbs on its tail.', 'Ocean', 'Carnivorous; feeds on mollusks, crustaceans, and small fish.', 'Vulnerable', 'Stingrays use their tail spines for defense and exhibit a unique, graceful swimming style that has fascinated divers for decades.', 'Eagle Ray, Manta Ray', 'https://tse4.mm.bing.net/th/id/OIP.G8W3ppzMghJs_by37vnl8AHaF7?rs=1&pid=ImgDetMain', 'https://media1.tenor.com/m/aRIusKA2iPMAAAAd/orca-slaps.gif', 'https://www.youtube.com/embed/jUxObdjZNxE?si=e5PxgJTj7uD7a6U4', 'Stingrays are flat-bodied cartilaginous fish related to sharks, characterized by their wing-like pectoral fins that undulate to propel them through water with remarkable grace. Their flattened bodies are perfectly adapted for a life on the seafloor, where many species spend much of their time partially buried in sand. Most stingrays possess one or more serrated, venomous spines on their whip-like tails used solely for defense. They locate prey buried in sand using specialized electromagnetic sensors called ampullae of Lorenzini, then uncover and consume them using powerful plate-like teeth designed for crushing shells and exoskeletons. Most species give birth to live young rather than laying eggs. Despite their defensive capabilities, stingrays are typically docile animals that prefer to flee rather than confront potential threats, only using their spines when they feel cornered or threatened.', 'Medium'),
(17, 'Vampire Squid', 'Vampyroteuthis infernalis', 'A deep-sea cephalopod with webbed arms and bioluminescent capabilities.', 'Deep Ocean', 'Detritivore; feeds on marine snow (organic debris falling from upper layers of the ocean).', 'Least Concern', 'Despite its name, the vampire squid is not predatory. It uses bioluminescent displays to confuse predators and has a fascinating survival strategy in low-oxygen environments.', 'Firefly Squid, Glass Squid', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_XiPjXvjIy-VTfQ8FR7rvsfeq15PR89Fju9WmUAd1uvyB3leT38V7oTdxODV1Vr_sv_-Di3sLPncPHoc950pM7A', 'https://media1.giphy.com/media/jQTvIc6w5Hvk4wRgck/giphy.gif?cid=6c09b952imznr5kf0tix5u2ckjodsh272udh7i8b0dg6josj&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=g', 'https://www.youtube.com/embed/CRM9PEg_3Xc?si=6XGxDm4PRRAvP-CD', 'A unique deep-sea cephalopod with a gelatinous body, red coloration, and webbed arms resembling a cloak. It is adapted to survive in oxygen-depleted zones of the ocean. Despite its name, the vampire squid is not predatory. It uses bioluminescent displays to confuse predators and has a fascinating survival strategy in low-oxygen environments.', 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `loginid`, `password`, `name`) VALUES
(1, 'Siddhant_Shukla', 'siddhant.shukla@somaiya.edu', 'test1', '$2y$10$U6gCwgTBxE1TKYZ9FbXBS.O6DFvBidXLVGcMVCRCCz7iYqworkVgi', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL,
  `loginId` varchar(30) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`feedback_id`, `loginId`, `username`, `name`, `feedback`) VALUES
(2, 'test1', 'Siddhant_Shukla', 'Siddhant Shukla', 'I love the site'),
(3, 'test1', 'Siddhant_Shukla', 'Siddhant', 'We all love this site'),
(4, 'test1', 'Siddhant_Shukla', 'Hello', 'hello'),
(5, 'test1', 'Siddhant_Shukla', 'yup', 'ilvit'),
(6, 'test1', 'Siddhant_Shukla', 'ufiun3', 'fienwfnwi'),
(7, 'test1', 'Siddhant_Shukla', 'IAMDON', 'I love it'),
(8, 'test1', 'Siddhant_Shukla', 'Navya', 'Colour change kar'),
(9, 'test1', 'Siddhant_Shukla', 'Delulu boy', 'Acha hai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `initiatives`
--
ALTER TABLE `initiatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_viewed`
--
ALTER TABLE `last_viewed`
  ADD PRIMARY KEY (`loginId`),
  ADD KEY `species_id` (`species_id`);

--
-- Indexes for table `marine_animals`
--
ALTER TABLE `marine_animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `loginid` (`loginid`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_loginid` (`loginId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `initiatives`
--
ALTER TABLE `initiatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `marine_animals`
--
ALTER TABLE `marine_animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `last_viewed`
--
ALTER TABLE `last_viewed`
  ADD CONSTRAINT `last_viewed_ibfk_1` FOREIGN KEY (`loginId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `last_viewed_ibfk_2` FOREIGN KEY (`species_id`) REFERENCES `marine_animals` (`id`);

--
-- Constraints for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD CONSTRAINT `fk_loginid` FOREIGN KEY (`loginId`) REFERENCES `users` (`loginid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
