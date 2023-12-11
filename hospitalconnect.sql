-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 10:56 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile`, `username`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '1234567890', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(11) NOT NULL,
  `disease_name` text NOT NULL,
  `cause` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `disease_name`, `cause`) VALUES
(1, 'Autoimmune Diseases', 'Multiple sclerosis, or MS, is a disease of the central nervous system in which the bodyâ€™s immune system attacks myelin, the tissue that covers nerves. This interferes with neural communication between the brain and the body.'),
(2, 'Autism and Neural Development Diseases', 'Autism spectrum disorder is a developmental condition that affects an individualâ€™s ability to communicate and interact with others. The disorder can be diagnosed at any age, but symptoms typically appear within the first two years of life.'),
(3, 'Dementia', 'Symptoms of dementia include a progressive loss of cognitive and functional ability, leading to a loss of independence. There are currently no effective treatments, but many trials are underway that may offer hope to patients and their families.'),
(4, 'Brain Infections', 'Common brain diseases caused by an infection include meningitis and encephalitis. Meningitis is an infection in the lining around the brain or spinal cord. Encephalitis is an infection of the brain tissue.'),
(5, 'Movement Disorders', 'Parkinsonâ€™s disease, ataxias, tremor, dystonia, tics and Tourette syndrome are examples of movement disorders that often progress to a complete loss of function. They can lead to tremors, slow and stiff movement, loss of balance.'),
(6, 'Neuromuscular Diseases', 'These disorders attack peripheral nerves outside the brain and the muscles they control. Amyotrophic lateral sclerosis, commonly referred to as ALS or Lou Gehrigâ€™s disease, is the best known of these diseases.'),
(7, 'Seizure Disorders', 'Epilepsy and other seizure disorders affect about 3.4 million people, according to the Centers for Disease Control and Prevention. Seizures are caused by a disruption in brain activity, either because of illness, brain damage or other factors.'),
(8, 'Stroke and Vascular Diseases', 'Stroke is the leading cause of permanent disability in adults. An ischemic stroke is when blood flow to the brain is impaired by a blocked blood vessel. A hemorrhagic stroke is when a blood vessel in the brain ruptures, causing bleeding into the brain.'),
(9, 'Trauma', 'Trauma, including concussion, can be mild or severe, and can cause anything from a mild headache to confusion, loss of consciousness, convulsions and even death. Benish stresses the importance of head protection for everyone.'),
(10, 'Tumors', 'Both benign and malignant tumors can put pressure on brain tissue or destroy tissue, causing problems in the body associated with the area of the brain affected. Tumors can start within the brain or metastasize there from other organs.'),
(11, 'Scoliosis', 'Most often, the cause of scoliosis, or abnormal curvature of the spine, is unknown â€“ called idiopathic scoliosis. In other cases, it may be degenerative and occur as a person ages.'),
(12, 'Spina Bifida', 'This birth defect â€“ specifically whatâ€™s called a neural tube defect â€“ occurs on a continuum: It can be more or less severe. The most severe form is known as myelomeningocele.Depending upon severity, spina bifida can lead to a range of complications.'),
(13, 'Bells Palsy', 'This condition causes temporary paralysis or weakness of one side of the face. â€œItâ€™s a loss of function of the seventh cranial nerve,â€ Lawton explains. '),
(14, 'Appendicitis', 'Appendicitis may be caused by various infections such as virus, bacteria or parasites, in your digestive tract'),
(15, 'SIBO', 'SIBO occurs when bacteria from the large intestine migrate to the small intestine');

-- --------------------------------------------------------

--
-- Table structure for table `link_symptoms`
--

CREATE TABLE `link_symptoms` (
  `id` int(11) NOT NULL,
  `organ_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `link_symptoms`
--

INSERT INTO `link_symptoms` (`id`, `organ_id`, `disease_id`, `symptom_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 1, 5),
(6, 1, 2, 1),
(7, 1, 2, 6),
(8, 1, 2, 7),
(9, 1, 2, 8),
(10, 1, 2, 9),
(11, 1, 2, 10),
(12, 1, 2, 11),
(13, 1, 3, 12),
(14, 1, 3, 13),
(15, 1, 3, 14),
(16, 1, 3, 15),
(17, 1, 3, 16),
(18, 1, 3, 8),
(19, 1, 3, 9),
(20, 1, 4, 17),
(21, 1, 5, 18),
(22, 1, 5, 19),
(23, 1, 5, 20),
(24, 1, 6, 21),
(25, 1, 6, 22),
(26, 1, 6, 23),
(27, 1, 6, 24),
(28, 1, 6, 25),
(29, 1, 7, 26),
(30, 1, 7, 11),
(31, 1, 7, 24),
(32, 1, 7, 17),
(33, 1, 8, 11),
(34, 1, 8, 27),
(35, 1, 8, 28),
(36, 1, 9, 29),
(37, 1, 9, 30),
(38, 1, 9, 31),
(39, 1, 10, 17),
(40, 1, 10, 10),
(41, 1, 10, 32),
(42, 1, 10, 33),
(43, 1, 10, 24),
(44, 1, 10, 15),
(45, 1, 10, 34),
(46, 1, 10, 35),
(47, 1, 11, 36),
(48, 1, 11, 37),
(49, 1, 11, 38),
(50, 1, 12, 39),
(51, 1, 12, 40),
(52, 1, 12, 41),
(53, 1, 13, 42),
(54, 1, 13, 43),
(55, 1, 13, 17),
(56, 1, 13, 44),
(57, 1, 13, 45),
(58, 2, 14, 46),
(59, 2, 14, 47),
(60, 2, 14, 10),
(61, 2, 14, 48),
(62, 2, 14, 49),
(63, 2, 15, 48),
(64, 2, 15, 49),
(65, 2, 15, 50);

-- --------------------------------------------------------

--
-- Table structure for table `organs`
--

CREATE TABLE `organs` (
  `id` int(11) NOT NULL,
  `organ_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organs`
--

INSERT INTO `organs` (`id`, `organ_name`) VALUES
(1, 'Head'),
(2, 'Stomach'),
(3, 'eye');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `health_card_no` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `aadhar_no` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `history` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_prescriptions`
--

CREATE TABLE `patient_prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `schedule` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `symptom_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `symptom_name`) VALUES
(1, 'Trouble concentrating'),
(2, 'Fatigue'),
(3, 'Hair loss'),
(4, 'Swelling and redness'),
(5, 'Skin Rashes'),
(6, 'Avoids eye contact.'),
(7, 'Not recognizing sarcasm or joking.'),
(8, 'Constant moving (pacing) and â€œhyperâ€ behavior.'),
(9, 'high fever'),
(10, 'Nausea and Vomiting'),
(11, 'Confusion and disorientation'),
(12, 'Memory loss, which is usually noticed by a spouse or someone else.'),
(13, 'Difficulty communicating or finding words'),
(14, 'Difficulty with planning and organizing'),
(15, 'Confusion and disorientation'),
(16, 'Depression'),
(17, 'Severe headache'),
(18, ' uncoordinated or clumsy balance, speech or limb movements'),
(19, 'low blood pressure and impaired bladder function.'),
(20, 'abnormal feelings in the legs while relaxing or lying down, often relieved by movement.'),
(21, 'Numbness, tingling or painful sensations'),
(22, 'Trouble breathing'),
(23, 'Double vision in a single eye'),
(24, 'Balance problems'),
(25, 'Movement issues'),
(26, 'Sudden numbness or weakness of the face, arm or leg (especially on one side of the body)'),
(27, 'Uncontrollable jerking movements of the arms and leg'),
(28, 'Cognitive or emotional symptoms, such as fear, anxiety or deja vu'),
(29, 'distressing, unwanted memories, vivid nightmares and/or flashbacks'),
(30, 'Negative thoughts and feelings such as fear, anger, guilt, or feeling flat or numb a lot of the time'),
(31, 'trouble sleeping or concentrating, feeling angry or irritable, taking risks'),
(32, 'Blurred vision'),
(33, 'Gradual loss of sensation or movement in an arm or a leg'),
(34, 'Personality or behavior changes'),
(35, 'Hearing problems'),
(36, 'One shoulder blade that appears more prominent than the other'),
(37, 'Uneven shoulders'),
(38, 'One hip higher than the other'),
(39, 'Weak leg muscles (in some cases, the infant cant move them at all)'),
(40, 'Bowel or bladder problems.'),
(41, 'Seizures.'),
(42, 'Pain around the jaw or in or behind your ear on the affected side'),
(43, 'Increased sensitivity to sound on the affected side'),
(44, 'A changed sense of taste'),
(45, 'Changes in the amount of tears and saliva you produce'),
(46, 'Sudden pain that begins on the right side of the lower abdomen'),
(47, 'Sudden pain that begins around your navel and often shifts to your lower right abdomen'),
(48, 'Constipation or diarrhea'),
(49, 'Abdominal bloating'),
(50, 'chest pain');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_phone` varchar(255) NOT NULL,
  `hospital_email` varchar(255) NOT NULL,
  `hospital_city` int(11) NOT NULL,
  `hospital_address` text NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_phone` varchar(255) NOT NULL,
  `doctor_qualification` varchar(255) NOT NULL,
  `doctor_speciality` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hospital_name`, `hospital_phone`, `hospital_email`, `hospital_city`, `hospital_address`, `doctor_name`, `doctor_phone`, `doctor_qualification`, `doctor_speciality`, `photo`, `username`, `password`, `status`) VALUES
(1, 'Vishwas Hospital', '08338222233', 'vishwashospital@gmail.com', 2, 'Nipani', 'Dr. Deepak Deshpande', '8989959595', 'MBBS', '1', '', 'vishwas', 'vishwas', 1),
(2, 'Kesarkar Hospital', '7709054042', 'kesarkar@gmail.com', 2, 'Akkol Road Near Court', 'Amit Kesarkar', '7709054043', 'MBBS,MD', '1', 'img_1655037874.jpeg', 'kesarkar', '123456', 1),
(3, 'Jeev hospital', '9876598756', 'jeev12@gmail.com', 2, 'parvati nagar', 'DR. Umesh Renake', '9876543219', 'MBBS', '2', 'img_1655452658.jpg', 'Jeev', 'jeev', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_symptoms`
--
ALTER TABLE `link_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organs`
--
ALTER TABLE `organs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_prescriptions`
--
ALTER TABLE `patient_prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `link_symptoms`
--
ALTER TABLE `link_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `organs`
--
ALTER TABLE `organs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_prescriptions`
--
ALTER TABLE `patient_prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
