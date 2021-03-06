<?php

use Illuminate\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `calendar` (`id`, `date`, `day`, `month`, `bank_holiday`)
VALUES
	(1, 1, 'Wed', 'Jan', 'Y'),
	(2, 2, 'Thu', 'Jan', NULL),
	(3, 3, 'Fri', 'Jan', NULL),
	(4, 4, 'Sat', 'Jan', 'Unavailable'),
	(5, 5, 'Sun', 'Jan', 'Unavailable'),
	(6, 6, 'Mon', 'Jan', NULL),
	(7, 7, 'Tue', 'Jan', NULL),
	(8, 8, 'Wed', 'Jan', NULL),
	(9, 9, 'Thu', 'Jan', NULL),
	(10, 10, 'Fri', 'Jan', NULL),
	(11, 11, 'Sat', 'Jan', 'Unavailable'),
	(12, 12, 'Sun', 'Jan', 'Unavailable'),
	(13, 13, 'Mon', 'Jan', NULL),
	(14, 14, 'Tue', 'Jan', NULL),
	(15, 15, 'Wed', 'Jan', NULL),
	(16, 16, 'Thu', 'Jan', NULL),
	(17, 17, 'Fri', 'Jan', NULL),
	(18, 18, 'Sat', 'Jan', 'Unavailable'),
	(19, 19, 'Sun', 'Jan', 'Unavailable'),
	(20, 20, 'Mon', 'Jan', NULL),
	(21, 21, 'Tue', 'Jan', NULL),
	(22, 22, 'Wed', 'Jan', NULL),
	(23, 23, 'Thu', 'Jan', NULL),
	(24, 24, 'Fri', 'Jan', NULL),
	(25, 25, 'Sat', 'Jan', 'Unavailable'),
	(26, 26, 'Sun', 'Jan', 'Unavailable'),
	(27, 27, 'Mon', 'Jan', NULL),
	(28, 28, 'Tue', 'Jan', NULL),
	(29, 29, 'Wed', 'Jan', NULL),
	(30, 30, 'Thu', 'Jan', NULL),
	(31, 31, 'Fri', 'Jan', NULL),
	(32, 1, 'Sat', 'Feb', 'Unavailable'),
	(33, 2, 'Sun', 'Feb', 'Unavailable'),
	(34, 3, 'Mon', 'Feb', NULL),
	(35, 4, 'Tue', 'Feb', NULL),
	(36, 5, 'Wed', 'Feb', NULL),
	(37, 6, 'Thu', 'Feb', NULL),
	(38, 7, 'Fri', 'Feb', NULL),
	(39, 8, 'Sat', 'Feb', 'Unavailable'),
	(40, 9, 'Sun', 'Feb', 'Unavailable'),
	(41, 10, 'Mon', 'Feb', NULL),
	(42, 11, 'Tue', 'Feb', NULL),
	(43, 12, 'Wed', 'Feb', NULL),
	(44, 13, 'Thu', 'Feb', NULL),
	(45, 14, 'Fri', 'Feb', NULL),
	(46, 15, 'Sat', 'Feb', 'Unavailable'),
	(47, 16, 'Sun', 'Feb', 'Unavailable'),
	(48, 17, 'Mon', 'Feb', NULL),
	(49, 18, 'Tue', 'Feb', NULL),
	(50, 19, 'Wed', 'Feb', NULL),
	(51, 20, 'Thu', 'Feb', NULL),
	(52, 21, 'Fri', 'Feb', NULL),
	(53, 22, 'Sat', 'Feb', 'Unavailable'),
	(54, 23, 'Sun', 'Feb', 'Unavailable'),
	(55, 24, 'Mon', 'Feb', NULL),
	(56, 25, 'Tue', 'Feb', NULL),
	(57, 26, 'Wed', 'Feb', NULL),
	(58, 27, 'Thu', 'Feb', NULL),
	(59, 28, 'Fri', 'Feb', NULL),
	(60, 29, 'Sat', 'Feb', 'Unavailable'),
	(61, 1, 'Sun', 'Mar', 'Unavailable'),
	(62, 2, 'Mon', 'Mar', NULL),
	(63, 3, 'Tue', 'Mar', NULL),
	(64, 4, 'Wed', 'Mar', NULL),
	(65, 5, 'Thu', 'Mar', NULL),
	(66, 6, 'Fri', 'Mar', NULL),
	(67, 7, 'Sat', 'Mar', 'Unavailable'),
	(68, 8, 'Sun', 'Mar', 'Unavailable'),
	(69, 9, 'Mon', 'Mar', NULL),
	(70, 10, 'Tue', 'Mar', NULL),
	(71, 11, 'Wed', 'Mar', NULL),
	(72, 12, 'Thu', 'Mar', NULL),
	(73, 13, 'Fri', 'Mar', NULL),
	(74, 14, 'Sat', 'Mar', 'Unavailable'),
	(75, 15, 'Sun', 'Mar', 'Unavailable'),
	(76, 16, 'Mon', 'Mar', NULL),
	(77, 17, 'Tue', 'Mar', NULL),
	(78, 18, 'Wed', 'Mar', NULL),
	(79, 19, 'Thu', 'Mar', NULL),
	(80, 20, 'Fri', 'Mar', NULL),
	(81, 21, 'Sat', 'Mar', 'Unavailable'),
	(82, 22, 'Sun', 'Mar', 'Unavailable'),
	(83, 23, 'Mon', 'Mar', NULL),
	(84, 24, 'Tue', 'Mar', NULL),
	(85, 25, 'Wed', 'Mar', NULL),
	(86, 26, 'Thu', 'Mar', NULL),
	(87, 27, 'Fri', 'Mar', NULL),
	(88, 28, 'Sat', 'Mar', 'Unavailable'),
	(89, 29, 'Sun', 'Mar', 'Unavailable'),
	(90, 30, 'Mon', 'Mar', NULL),
	(91, 31, 'Tue', 'Mar', NULL),
	(92, 1, 'Wed', 'Apr', NULL),
	(93, 2, 'Thu', 'Apr', NULL),
	(94, 3, 'Fri', 'Apr', NULL),
	(95, 4, 'Sat', 'Apr', 'Unavailable'),
	(96, 5, 'Sun', 'Apr', 'Unavailable'),
	(97, 6, 'Mon', 'Apr', NULL),
	(98, 7, 'Tue', 'Apr', NULL),
	(99, 8, 'Wed', 'Apr', NULL),
	(100, 9, 'Thu', 'Apr', NULL),
	(101, 10, 'Fri', 'Apr', 'Y'),
	(102, 11, 'Sat', 'Apr', 'Unavailable'),
	(103, 12, 'Sun', 'Apr', 'Unavailable'),
	(104, 13, 'Mon', 'Apr', 'Y'),
	(105, 14, 'Tue', 'Apr', NULL),
	(106, 15, 'Wed', 'Apr', NULL),
	(107, 16, 'Thu', 'Apr', NULL),
	(108, 17, 'Fri', 'Apr', NULL),
	(109, 18, 'Sat', 'Apr', 'Unavailable'),
	(110, 19, 'Sun', 'Apr', 'Unavailable'),
	(111, 20, 'Mon', 'Apr', NULL),
	(112, 21, 'Tue', 'Apr', NULL),
	(113, 22, 'Wed', 'Apr', NULL),
	(114, 23, 'Thu', 'Apr', NULL),
	(115, 24, 'Fri', 'Apr', NULL),
	(116, 25, 'Sat', 'Apr', 'Unavailable'),
	(117, 26, 'Sun', 'Apr', 'Unavailable'),
	(118, 27, 'Mon', 'Apr', NULL),
	(119, 28, 'Tue', 'Apr', NULL),
	(120, 29, 'Wed', 'Apr', NULL),
	(121, 30, 'Thu', 'Apr', NULL),
	(122, 1, 'Fri', 'May', NULL),
	(123, 2, 'Sat', 'May', 'Unavailable'),
	(124, 3, 'Sun', 'May', 'Unavailable'),
	(125, 4, 'Mon', 'May', NULL),
	(126, 5, 'Tue', 'May', NULL),
	(127, 6, 'Wed', 'May', NULL),
	(128, 7, 'Thu', 'May', NULL),
	(129, 8, 'Fri', 'May', 'Y'),
	(130, 9, 'Sat', 'May', 'Unavailable'),
	(131, 10, 'Sun', 'May', 'Unavailable'),
	(132, 11, 'Mon', 'May', NULL),
	(133, 12, 'Tue', 'May', NULL),
	(134, 13, 'Wed', 'May', NULL),
	(135, 14, 'Thu', 'May', NULL),
	(136, 15, 'Fri', 'May', NULL),
	(137, 16, 'Sat', 'May', 'Unavailable'),
	(138, 17, 'Sun', 'May', 'Unavailable'),
	(139, 18, 'Mon', 'May', NULL),
	(140, 19, 'Tue', 'May', NULL),
	(141, 20, 'Wed', 'May', NULL),
	(142, 21, 'Thu', 'May', NULL),
	(143, 22, 'Fri', 'May', NULL),
	(144, 23, 'Sat', 'May', 'Unavailable'),
	(145, 24, 'Sun', 'May', 'Unavailable'),
	(146, 25, 'Mon', 'May', 'Y'),
	(147, 26, 'Tue', 'May', NULL),
	(148, 27, 'Wed', 'May', NULL),
	(149, 28, 'Thu', 'May', NULL),
	(150, 29, 'Fri', 'May', NULL),
	(151, 30, 'Sat', 'May', 'Unavailable'),
	(152, 31, 'Sun', 'May', 'Unavailable'),
	(153, 1, 'Mon', 'Jun', NULL),
	(154, 2, 'Tue', 'Jun', NULL),
	(155, 3, 'Wed', 'Jun', NULL),
	(156, 4, 'Thu', 'Jun', NULL),
	(157, 5, 'Fri', 'Jun', NULL),
	(158, 6, 'Sat', 'Jun', 'Unavailable'),
	(159, 7, 'Sun', 'Jun', 'Unavailable'),
	(160, 8, 'Mon', 'Jun', NULL),
	(161, 9, 'Tue', 'Jun', NULL),
	(162, 10, 'Wed', 'Jun', NULL),
	(163, 11, 'Thu', 'Jun', NULL),
	(164, 12, 'Fri', 'Jun', NULL),
	(165, 13, 'Sat', 'Jun', 'Unavailable'),
	(166, 14, 'Sun', 'Jun', 'Unavailable'),
	(167, 15, 'Mon', 'Jun', NULL),
	(168, 16, 'Tue', 'Jun', NULL),
	(169, 17, 'Wed', 'Jun', NULL),
	(170, 18, 'Thu', 'Jun', NULL),
	(171, 19, 'Fri', 'Jun', NULL),
	(172, 20, 'Sat', 'Jun', 'Unavailable'),
	(173, 21, 'Sun', 'Jun', 'Unavailable'),
	(174, 22, 'Mon', 'Jun', NULL),
	(175, 23, 'Tue', 'Jun', NULL),
	(176, 24, 'Wed', 'Jun', NULL),
	(177, 25, 'Thu', 'Jun', NULL),
	(178, 26, 'Fri', 'Jun', NULL),
	(179, 27, 'Sat', 'Jun', 'Unavailable'),
	(180, 28, 'Sun', 'Jun', 'Unavailable'),
	(181, 29, 'Mon', 'Jun', NULL),
	(182, 30, 'Tue', 'Jun', NULL),
	(183, 1, 'Wed', 'Jul', NULL),
	(184, 2, 'Thu', 'Jul', NULL),
	(185, 3, 'Fri', 'Jul', NULL),
	(186, 4, 'Sat', 'Jul', 'Unavailable'),
	(187, 5, 'Sun', 'Jul', 'Unavailable'),
	(188, 6, 'Mon', 'Jul', NULL),
	(189, 7, 'Tue', 'Jul', NULL),
	(190, 8, 'Wed', 'Jul', NULL),
	(191, 9, 'Thu', 'Jul', NULL),
	(192, 10, 'Fri', 'Jul', NULL),
	(193, 11, 'Sat', 'Jul', 'Unavailable'),
	(194, 12, 'Sun', 'Jul', 'Unavailable'),
	(195, 13, 'Mon', 'Jul', NULL),
	(196, 14, 'Tue', 'Jul', NULL),
	(197, 15, 'Wed', 'Jul', NULL),
	(198, 16, 'Thu', 'Jul', NULL),
	(199, 17, 'Fri', 'Jul', NULL),
	(200, 18, 'Sat', 'Jul', 'Unavailable'),
	(201, 19, 'Sun', 'Jul', 'Unavailable'),
	(202, 20, 'Mon', 'Jul', NULL),
	(203, 21, 'Tue', 'Jul', NULL),
	(204, 22, 'Wed', 'Jul', NULL),
	(205, 23, 'Thu', 'Jul', NULL),
	(206, 24, 'Fri', 'Jul', NULL),
	(207, 25, 'Sat', 'Jul', 'Unavailable'),
	(208, 26, 'Sun', 'Jul', 'Unavailable'),
	(209, 27, 'Mon', 'Jul', NULL),
	(210, 28, 'Tue', 'Jul', NULL),
	(211, 29, 'Wed', 'Jul', NULL),
	(212, 30, 'Thu', 'Jul', NULL),
	(213, 31, 'Fri', 'Jul', NULL),
	(214, 1, 'Sat', 'Aug', 'Unavailable'),
	(215, 2, 'Sun', 'Aug', 'Unavailable'),
	(216, 3, 'Mon', 'Aug', NULL),
	(217, 4, 'Tue', 'Aug', NULL),
	(218, 5, 'Wed', 'Aug', NULL),
	(219, 6, 'Thu', 'Aug', NULL),
	(220, 7, 'Fri', 'Aug', NULL),
	(221, 8, 'Sat', 'Aug', 'Unavailable'),
	(222, 9, 'Sun', 'Aug', 'Unavailable'),
	(223, 10, 'Mon', 'Aug', NULL),
	(224, 11, 'Tue', 'Aug', NULL),
	(225, 12, 'Wed', 'Aug', NULL),
	(226, 13, 'Thu', 'Aug', NULL),
	(227, 14, 'Fri', 'Aug', NULL),
	(228, 15, 'Sat', 'Aug', 'Unavailable'),
	(229, 16, 'Sun', 'Aug', 'Unavailable'),
	(230, 17, 'Mon', 'Aug', NULL),
	(231, 18, 'Tue', 'Aug', NULL),
	(232, 19, 'Wed', 'Aug', NULL),
	(233, 20, 'Thu', 'Aug', NULL),
	(234, 21, 'Fri', 'Aug', NULL),
	(235, 22, 'Sat', 'Aug', 'Unavailable'),
	(236, 23, 'Sun', 'Aug', 'Unavailable'),
	(237, 24, 'Mon', 'Aug', NULL),
	(238, 25, 'Tue', 'Aug', NULL),
	(239, 26, 'Wed', 'Aug', NULL),
	(240, 27, 'Thu', 'Aug', NULL),
	(241, 28, 'Fri', 'Aug', NULL),
	(242, 29, 'Sat', 'Aug', 'Unavailable'),
	(243, 30, 'Sun', 'Aug', 'Unavailable'),
	(244, 31, 'Mon', 'Aug', 'Y'),
	(245, 1, 'Tue', 'Sep', NULL),
	(246, 2, 'Wed', 'Sep', NULL),
	(247, 3, 'Thu', 'Sep', NULL),
	(248, 4, 'Fri', 'Sep', NULL),
	(249, 5, 'Sat', 'Sep', 'Unavailable'),
	(250, 6, 'Sun', 'Sep', 'Unavailable'),
	(251, 7, 'Mon', 'Sep', NULL),
	(252, 8, 'Tue', 'Sep', NULL),
	(253, 9, 'Wed', 'Sep', NULL),
	(254, 10, 'Thu', 'Sep', NULL),
	(255, 11, 'Fri', 'Sep', NULL),
	(256, 12, 'Sat', 'Sep', 'Unavailable'),
	(257, 13, 'Sun', 'Sep', 'Unavailable'),
	(258, 14, 'Mon', 'Sep', NULL),
	(259, 15, 'Tue', 'Sep', NULL),
	(260, 16, 'Wed', 'Sep', NULL),
	(261, 17, 'Thu', 'Sep', NULL),
	(262, 18, 'Fri', 'Sep', NULL),
	(263, 19, 'Sat', 'Sep', 'Unavailable'),
	(264, 20, 'Sun', 'Sep', 'Unavailable'),
	(265, 21, 'Mon', 'Sep', NULL),
	(266, 22, 'Tue', 'Sep', NULL),
	(267, 23, 'Wed', 'Sep', NULL),
	(268, 24, 'Thu', 'Sep', NULL),
	(269, 25, 'Fri', 'Sep', NULL),
	(270, 26, 'Sat', 'Sep', 'Unavailable'),
	(271, 27, 'Sun', 'Sep', 'Unavailable'),
	(272, 28, 'Mon', 'Sep', NULL),
	(273, 29, 'Tue', 'Sep', NULL),
	(274, 30, 'Wed', 'Sep', NULL),
	(275, 1, 'Thu', 'Oct', NULL),
	(276, 2, 'Fri', 'Oct', NULL),
	(277, 3, 'Sat', 'Oct', 'Unavailable'),
	(278, 4, 'Sun', 'Oct', 'Unavailable'),
	(279, 5, 'Mon', 'Oct', NULL),
	(280, 6, 'Tue', 'Oct', NULL),
	(281, 7, 'Wed', 'Oct', NULL),
	(282, 8, 'Thu', 'Oct', NULL),
	(283, 9, 'Fri', 'Oct', NULL),
	(284, 10, 'Sat', 'Oct', 'Unavailable'),
	(285, 11, 'Sun', 'Oct', 'Unavailable'),
	(286, 12, 'Mon', 'Oct', NULL),
	(287, 13, 'Tue', 'Oct', NULL),
	(288, 14, 'Wed', 'Oct', NULL),
	(289, 15, 'Thu', 'Oct', NULL),
	(290, 16, 'Fri', 'Oct', NULL),
	(291, 17, 'Sat', 'Oct', 'Unavailable'),
	(292, 18, 'Sun', 'Oct', 'Unavailable'),
	(293, 19, 'Mon', 'Oct', NULL),
	(294, 20, 'Tue', 'Oct', NULL),
	(295, 21, 'Wed', 'Oct', NULL),
	(296, 22, 'Thu', 'Oct', NULL),
	(297, 23, 'Fri', 'Oct', NULL),
	(298, 24, 'Sat', 'Oct', 'Unavailable'),
	(299, 25, 'Sun', 'Oct', 'Unavailable'),
	(300, 26, 'Mon', 'Oct', NULL),
	(301, 27, 'Tue', 'Oct', NULL),
	(302, 28, 'Wed', 'Oct', NULL),
	(303, 29, 'Thu', 'Oct', NULL),
	(304, 30, 'Fri', 'Oct', NULL),
	(305, 31, 'Sat', 'Oct', 'Unavailable'),
	(306, 1, 'Sun', 'Nov', 'Unavailable'),
	(307, 2, 'Mon', 'Nov', NULL),
	(308, 3, 'Tue', 'Nov', NULL),
	(309, 4, 'Wed', 'Nov', NULL),
	(310, 5, 'Thu', 'Nov', NULL),
	(311, 6, 'Fri', 'Nov', NULL),
	(312, 7, 'Sat', 'Nov', 'Unavailable'),
	(313, 8, 'Sun', 'Nov', 'Unavailable'),
	(314, 9, 'Mon', 'Nov', NULL),
	(315, 10, 'Tue', 'Nov', NULL),
	(316, 11, 'Wed', 'Nov', NULL),
	(317, 12, 'Thu', 'Nov', NULL),
	(318, 13, 'Fri', 'Nov', NULL),
	(319, 14, 'Sat', 'Nov', 'Unavailable'),
	(320, 15, 'Sun', 'Nov', 'Unavailable'),
	(321, 16, 'Mon', 'Nov', NULL),
	(322, 17, 'Tue', 'Nov', NULL),
	(323, 18, 'Wed', 'Nov', NULL),
	(324, 19, 'Thu', 'Nov', NULL),
	(325, 20, 'Fri', 'Nov', NULL),
	(326, 21, 'Sat', 'Nov', 'Unavailable'),
	(327, 22, 'Sun', 'Nov', 'Unavailable'),
	(328, 23, 'Mon', 'Nov', NULL),
	(329, 24, 'Tue', 'Nov', NULL),
	(330, 25, 'Wed', 'Nov', NULL),
	(331, 26, 'Thu', 'Nov', NULL),
	(332, 27, 'Fri', 'Nov', NULL),
	(333, 28, 'Sat', 'Nov', 'Unavailable'),
	(334, 29, 'Sun', 'Nov', 'Unavailable'),
	(335, 30, 'Mon', 'Nov', NULL),
	(336, 1, 'Tue', 'Dec', NULL),
	(337, 2, 'Wed', 'Dec', NULL),
	(338, 3, 'Thu', 'Dec', NULL),
	(339, 4, 'Fri', 'Dec', NULL),
	(340, 5, 'Sat', 'Dec', 'Unavailable'),
	(341, 6, 'Sun', 'Dec', 'Unavailable'),
	(342, 7, 'Mon', 'Dec', NULL),
	(343, 8, 'Tue', 'Dec', NULL),
	(344, 9, 'Wed', 'Dec', NULL),
	(345, 10, 'Thu', 'Dec', NULL),
	(346, 11, 'Fri', 'Dec', NULL),
	(347, 12, 'Sat', 'Dec', 'Unavailable'),
	(348, 13, 'Sun', 'Dec', 'Unavailable'),
	(349, 14, 'Mon', 'Dec', NULL),
	(350, 15, 'Tue', 'Dec', NULL),
	(351, 16, 'Wed', 'Dec', NULL),
	(352, 17, 'Thu', 'Dec', NULL),
	(353, 18, 'Fri', 'Dec', NULL),
	(354, 19, 'Sat', 'Dec', 'Unavailable'),
	(355, 20, 'Sun', 'Dec', 'Unavailable'),
	(356, 21, 'Mon', 'Dec', NULL),
	(357, 22, 'Tue', 'Dec', NULL),
	(358, 23, 'Wed', 'Dec', NULL),
	(359, 24, 'Thu', 'Dec', NULL),
	(360, 25, 'Fri', 'Dec', 'Y'),
	(361, 26, 'Sat', 'Dec', 'Unavailable'),
	(362, 27, 'Sun', 'Dec', 'Unavailable'),
	(363, 28, 'Mon', 'Dec', 'Y'),
	(364, 29, 'Tue', 'Dec', NULL),
	(365, 30, 'Wed', 'Dec', NULL),
	(366, 31, 'Thu', 'Dec', NULL);
");
    }
}
