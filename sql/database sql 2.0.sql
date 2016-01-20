--
-- 数据库: `wetrial`
--

CREATE DATABASE IF NOT EXISTS wetrial DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `wt_action`
--

CREATE TABLE IF NOT EXISTS `wt_action` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `uid` int(11) NOT NULL COMMENT '操作用户ID',
  `action_type` int(4) DEFAULT NULL COMMENT '操作类型',
  `model_type` int(11) DEFAULT '0',
  `source_id` varchar(16) DEFAULT '0' COMMENT '关联 ID',
  `action_time` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`action_id`),
  KEY `uid` (`uid`),
  KEY `source_id` (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_action_data`
--

CREATE TABLE IF NOT EXISTS `wt_action_data` (
  `action_id` int(11) unsigned NOT NULL,
  `data` text,
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志数据表';

-- --------------------------------------------------------

--
-- 表的结构 `wt_evaluate_period`
--

CREATE TABLE IF NOT EXISTS `wt_evaluate_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '阶段ID',
  `uid` int(11) NOT NULL COMMENT '添加管理员ID',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '截至时间',
  `evaluate_name` varchar(255) DEFAULT NULL COMMENT '阶段名称',
  `token` varchar(32) NOT NULL COMMENT '识别码',
  `add_time` int(10) DEFAULT NULL COMMENT '添加时间，自动生成',
  `update_time` int(10) DEFAULT NULL COMMENT '最近更新时间，自动生成',
  `state` tinyint(1) DEFAULT NULL COMMENT '阶段状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`),
  KEY `state` (`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置评审开启' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_major`
--

CREATE TABLE IF NOT EXISTS `wt_major` (
  `major_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '领域 ID',
  `major_name` varchar(255) DEFAULT NULL COMMENT '领域名称',
  `state` tinyint(1) DEFAULT '1' COMMENT '领域状态',
  PRIMARY KEY (`major_id`),
  KEY `state` (`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper`
--

CREATE TABLE IF NOT EXISTS `wt_paper` (
  `paper_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '论文ID',
  `uid` int(11) NOT NULL COMMENT '论文作者ID',
  `paper_title` varchar(255) DEFAULT NULL COMMENT '论文题目',
  `paper_number` varchar(32) DEFAULT NULL COMMENT '论文编号，院办制定',
  `paper_abstract` text COMMENT '论文摘要',
  `paper_location` varchar(255) DEFAULT NULL COMMENT '论文文件位置',
  `paper_major` int(10) DEFAULT NULL COMMENT '所属领域',
  `token` varchar(255) DEFAULT NULL COMMENT '学期标识符',
  `apply_time` int(10) DEFAULT NULL COMMENT '申请时间',
  `tutor_uid` int(11) DEFAULT '0' COMMENT '导师ID',
  `tutor_name` varchar(255) DEFAULT NULL COMMENT '导师姓名',
  `tutor_opinion` varchar(255) DEFAULT NULL COMMENT '导师意见',
  `tutor_time` int(10) DEFAULT NULL COMMENT '导师审核时间',
  `inst_opinion` varchar(512) DEFAULT NULL COMMENT '学院意见',
  `inst_time` int(10) DEFAULT NULL COMMENT '学院审核时间',
  `paper_step` int(10) NOT NULL DEFAULT '0' COMMENT '评审进程',
  `repet_res` tinyint(1) DEFAULT '0' COMMENT '不端检测结果：0->等待检测; 1->通过检测; -1->未通过检测',
  `check_res` tinyint(1) DEFAULT '0' COMMENT '盲审结果：0->等待盲审; 1->通过盲审; 2->需要修改; -1>未通过盲审',
  PRIMARY KEY (`paper_id`),
  KEY `uid` (`uid`),
  KEY `repet_res` (`repet_res`),
  KEY `check_res` (`check_res`),
  KEY `paper_major` (`paper_major`),
  KEY `paper_step` (`paper_step`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper_blind`
--

CREATE TABLE IF NOT EXISTS `wt_paper_blind` (
  `blind_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '盲审结果ID',
  `paper_id` int(11) NOT NULL COMMENT '论文ID',
  `uid` int(11) NOT NULL COMMENT '专家ID',
  `blind_res` int(4) DEFAULT '0' COMMENT '盲审结果ID',
  `blind_remark` text COMMENT '修改说明',
  `blind_review` text COMMENT '学术评语',
  `blind_proposal` text NOT NULL COMMENT '论文建议，必填',
  `if_familiar` tinyint(1) DEFAULT '0' COMMENT '是否熟悉论文内容：1->很熟悉; 2->熟悉; 3->一般; 4->不熟悉',
  `blind_time` int(10) DEFAULT NULL COMMENT '盲审时间，自动生成',
  `add_time` int(10) DEFAULT NULL COMMENT '分配时间，自动生成',
  PRIMARY KEY (`blind_id`),
  KEY `paper_id` (`paper_id`),
  KEY `uid` (`uid`),
  KEY `blind_res` (`blind_res`),
  KEY `if_familiar` (`if_familiar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论文盲审结果' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper_blind_result`
--

CREATE TABLE IF NOT EXISTS `wt_paper_blind_result` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '盲审结果ID',
  `res_str` varchar(255) NOT NULL COMMENT '盲审结果',
  `res_state` tinyint(1) DEFAULT '1' COMMENT '结果状态',
  PRIMARY KEY (`res_id`),
  KEY `res_state` (`res_state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='论文盲审预设结果' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `wt_paper_blind_result`
--

INSERT INTO `wt_paper_blind_result` (`res_id`, `res_str`, `res_state`) VALUES
(1, '符合硕士学位论文要求，准予答辩', 1),
(2, '基本符合硕士学位论文要求，论文需进行一定修改后答辩', 1),
(3, '没有达到硕士学位论文的要求，不同意申请答辩', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper_check`
--

CREATE TABLE IF NOT EXISTS `wt_paper_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评审结果ID',
  `paper_id` int(11) NOT NULL COMMENT '论文ID',
  `if_paperver` tinyint(1) DEFAULT '0' COMMENT '是否已提交纸质版两份',
  `blind_res` text COMMENT 'JSON字符串，专家评审结果',
  `edit_res` text COMMENT 'JSON字符串，论文修改结果',
  `check_res` tinyint(1) DEFAULT '0' COMMENT '是否通过评审：1->通过评审; -1->未通过评审',
  `update_time` int(10) DEFAULT NULL COMMENT '最近更新时间',
  `add_time` int(10) DEFAULT NULL COMMENT '添加纪录时间',
  PRIMARY KEY (`id`),
  KEY `paper_id` (`paper_id`),
  KEY `update_time` (`update_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论文评审结果' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper_edit`
--

CREATE TABLE IF NOT EXISTS `wt_paper_edit` (
  `edit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '盲审结果ID',
  `paper_id` int(11) NOT NULL COMMENT '论文ID',
  `uid` int(11) NOT NULL COMMENT '专家ID',
  `edit_remark` text COMMENT '修改说明',
  `blind_res` int(4) DEFAULT '0' COMMENT '审核修改结果ID',
  `blind_remark` text COMMENT '对修改结果评价说明',
  `blind_time` int(10) DEFAULT NULL COMMENT '审核修改结果时间',
  `add_time` int(10) DEFAULT NULL COMMENT '添加时间，自动生成',
  PRIMARY KEY (`edit_id`),
  KEY `paper_id` (`paper_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论文修改记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_paper_repet`
--

CREATE TABLE IF NOT EXISTS `wt_paper_repet` (
  `repet_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '不端检测记录ID',
  `paper_id` int(11) NOT NULL COMMENT '论文ID',
  `repet_uid` int(11) DEFAULT '0' COMMENT '检测负责老师ID',
  `repet_rate` int(4) DEFAULT '0' COMMENT '检测结果重复率',
  `repet_res` int(4) DEFAULT '0' COMMENT '检测结果，系统管理员配置',
  `repet_time` int(10) DEFAULT NULL COMMENT '检测时间',
  `add_time` int(10) DEFAULT NULL COMMENT '录入时间，自动生成',
  PRIMARY KEY (`repet_id`),
  KEY `paper_id` (`paper_id`),
  KEY `repet_uid` (`repet_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学术不端检测结果' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_system_setting`
--

CREATE TABLE IF NOT EXISTS `wt_system_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `varname` varchar(255) NOT NULL COMMENT '字段名',
  `value` text COMMENT '变量值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `varname` (`varname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_users`
--

CREATE TABLE IF NOT EXISTS `wt_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户的 UID',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '用户密码',
  `user_number` varchar(32) DEFAULT NULL COMMENT '学号',
  `email` varchar(255) DEFAULT NULL COMMENT 'EMAIL',
  `mobile` varchar(16) DEFAULT NULL COMMENT '用户手机',
  `avatar_file` varchar(128) DEFAULT NULL COMMENT '头像文件',
  `sex` tinyint(1) DEFAULT NULL COMMENT '性别',
  `status_id` tinyint(1) DEFAULT '0' COMMENT '身份ID',
  `entrance_time` int(10) DEFAULT NULL COMMENT '入学时间',
  `if_degree` tinyint(1) DEFAULT '1' COMMENT '是否有学位资格',
  `reg_time` int(10) DEFAULT NULL COMMENT '注册时间',
  `state` tinyint(1) DEFAULT '1' COMMENT '账号状态',
  PRIMARY KEY (`uid`),
  KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `status_id` (`status_id`),
  KEY `if_degree` (`if_degree`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wt_users`
--

INSERT INTO `wt_users` (`uid`, `user_name`, `password`, `user_number`, `email`, `mobile`, `avatar_file`, `sex`, `status_id`, `entrance_time`, `if_degree`, `reg_time`, `state`) VALUES
(1, 'admin', '1023qq1216', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wt_users_extradata`
--

CREATE TABLE IF NOT EXISTS `wt_users_extradata` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户的 UID',
  `user_idno` varchar(32) DEFAULT NULL COMMENT '身份证号或工号',
  `user_unit` varchar(255) DEFAULT NULL COMMENT '工作单位',
  `user_post` varchar(255) DEFAULT NULL COMMENT '专业技术职务',
  `user_specialty` varchar(255) DEFAULT NULL COMMENT '专业专长',
  `if_leader` tinyint(1) DEFAULT '0' COMMENT '是否领导',
  `leader_name` varchar(255) DEFAULT NULL COMMENT '职称',
  KEY `uid` (`uid`),
  KEY `user_idno` (`user_idno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wt_users_relation`
--

CREATE TABLE IF NOT EXISTS `wt_users_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '关系 ID',
  `teacher_id` int(11) NOT NULL COMMENT '导师 UID',
  `student_id` int(11) NOT NULL COMMENT '学生 UID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导师学生关系' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wt_users_status`
--

CREATE TABLE IF NOT EXISTS `wt_users_status` (
  `status_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户身份 ID',
  `status_name` varchar(255) DEFAULT NULL COMMENT '身份名称',
  `state` tinyint(1) DEFAULT '1' COMMENT '身份状态',
  PRIMARY KEY (`status_id`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wt_users_status`
--

INSERT INTO `wt_users_status` (`status_id`, `status_name`, `state`) VALUES
(1, '研究生', 1),
(2, '管理员', 1),
(3, '研究生导师', 1),
(4, '专家', 1);
