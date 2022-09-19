-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2022 at 02:54 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monika-secret`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_krips`
--

CREATE TABLE `data_krips` (
  `code` char(25) CHARACTER SET utf8mb3   NOT NULL DEFAULT '',
  `lastupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) CHARACTER SET utf8mb3   NOT NULL DEFAULT '',
  `codename` varchar(100) CHARACTER SET utf8mb3   DEFAULT NULL,
  `open` double(18,4) DEFAULT NULL,
  `high` double(18,4) DEFAULT NULL,
  `low` double(18,4) DEFAULT NULL,
  `close` double(18,4) DEFAULT NULL,
  `chg` double(18,4) DEFAULT NULL,
  `volume` double(18,0) DEFAULT NULL,
  `vwap` double(18,4) DEFAULT NULL,
  `freq` double(12,0) DEFAULT NULL,
  `nbsa` double(18,2) DEFAULT NULL,
  `nbss` double(18,2) DEFAULT NULL,
  `cum_nbss` double(18,2) DEFAULT NULL,
  `macd` double(12,2) DEFAULT NULL,
  `sig_macd` double(12,2) DEFAULT NULL,
  `stok` double(12,2) DEFAULT NULL,
  `stod` double(12,2) DEFAULT NULL,
  `rsi` double(12,2) DEFAULT NULL,
  `ma_rsi` double(12,2) DEFAULT NULL,
  `adx` double(12,2) DEFAULT NULL,
  `pdi` double(12,2) DEFAULT NULL,
  `mdi` double(12,2) DEFAULT NULL,
  `up_cco` double(12,2) DEFAULT NULL,
  `lo_cco` double(12,2) DEFAULT NULL,
  `up_bb_band` double(12,2) DEFAULT NULL,
  `lo_bb_band` double(12,2) DEFAULT NULL,
  `lips` double(12,2) DEFAULT NULL,
  `teeth` double(12,2) DEFAULT NULL,
  `jaw` double(12,2) DEFAULT NULL,
  `fractal_up` double(12,2) DEFAULT NULL,
  `fractal_lo` double(12,2) DEFAULT NULL,
  `dsl` double(12,2) DEFAULT NULL,
  `up_cloud` double(12,2) DEFAULT NULL,
  `lo_cloud` double(12,2) DEFAULT NULL,
  `pivot_r1` double(12,2) DEFAULT NULL,
  `pivot_r2` double(12,2) DEFAULT NULL,
  `pivot_r3` double(12,2) DEFAULT NULL,
  `pivot_s1` double(12,2) DEFAULT NULL,
  `pivot_s2` double(12,2) DEFAULT NULL,
  `pivot_s3` double(12,2) DEFAULT NULL,
  `frek_analizer` double(12,2) DEFAULT NULL,
  `ha_o` double(12,2) DEFAULT NULL,
  `ha_h` double(12,2) DEFAULT NULL,
  `ha_l` double(12,2) DEFAULT NULL,
  `ha_c` double(12,2) DEFAULT NULL,
  `tp1` double(12,2) DEFAULT NULL,
  `tp2` double(12,2) DEFAULT NULL,
  `tp3` double(12,2) DEFAULT NULL,
  `sl` double(12,2) DEFAULT NULL,
  `gps_x` double(12,2) DEFAULT NULL,
  `gps_y` double(12,2) DEFAULT NULL,
  `sig_dsl` varchar(15) CHARACTER SET utf8mb3  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_pasar`
--

CREATE TABLE `data_pasar` (
  `code` char(25) CHARACTER SET utf8mb3   NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) CHARACTER SET utf8mb3   NOT NULL DEFAULT '',
  `open` double(18,0) DEFAULT NULL,
  `high` double(18,0) DEFAULT NULL,
  `low` double(18,0) DEFAULT NULL,
  `close` double(18,0) DEFAULT NULL,
  `chg` double(18,2) DEFAULT NULL,
  `volume` double(18,0) DEFAULT NULL,
  `vwap` double(18,0) DEFAULT NULL,
  `freq` double(12,0) DEFAULT NULL,
  `nbsa` double(18,2) DEFAULT NULL,
  `nbss` double(18,2) DEFAULT NULL,
  `cum_nbss` double(18,2) DEFAULT NULL,
  `macd` double(12,2) DEFAULT NULL,
  `sig_macd` double(12,2) DEFAULT NULL,
  `stok` double(12,2) DEFAULT NULL,
  `stod` double(12,2) DEFAULT NULL,
  `rsi` double(12,2) DEFAULT NULL,
  `ma_rsi` double(12,2) DEFAULT NULL,
  `adx` double(12,2) DEFAULT NULL,
  `pdi` double(12,2) DEFAULT NULL,
  `mdi` double(12,2) DEFAULT NULL,
  `up_cco` double(12,2) DEFAULT NULL,
  `lo_cco` double(12,2) DEFAULT NULL,
  `up_bb_band` double(12,2) DEFAULT NULL,
  `lo_bb_band` double(12,2) DEFAULT NULL,
  `lips` double(12,2) DEFAULT NULL,
  `teeth` double(12,2) DEFAULT NULL,
  `jaw` double(12,2) DEFAULT NULL,
  `fractal_up` double(12,2) DEFAULT NULL,
  `fractal_lo` double(12,2) DEFAULT NULL,
  `dsl` double(12,0) DEFAULT NULL,
  `up_cloud` double(12,2) DEFAULT NULL,
  `lo_cloud` double(12,2) DEFAULT NULL,
  `pivot_r1` double(12,0) DEFAULT NULL,
  `pivot_r2` double(12,0) DEFAULT NULL,
  `pivot_r3` double(12,0) DEFAULT NULL,
  `pivot_s1` double(12,0) DEFAULT NULL,
  `pivot_s2` double(12,0) DEFAULT NULL,
  `pivot_s3` double(12,0) DEFAULT NULL,
  `frek_analizer` double(12,2) DEFAULT NULL,
  `ha_o` double(12,2) DEFAULT NULL,
  `ha_h` double(12,2) DEFAULT NULL,
  `ha_l` double(12,2) DEFAULT NULL,
  `ha_c` double(12,2) DEFAULT NULL,
  `tp1` double(12,2) DEFAULT NULL,
  `tp2` double(12,2) DEFAULT NULL,
  `tp3` double(12,2) DEFAULT NULL,
  `sl` double(12,2) DEFAULT NULL,
  `gps_x` double(12,2) DEFAULT NULL,
  `gps_y` double(12,2) DEFAULT NULL,
  `sig_dsl` varchar(15) CHARACTER SET utf8mb3 DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prev_sig_dsl` varchar(15) CHARACTER SET utf8mb3 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `effective_value`
--

CREATE TABLE `effective_value` (
  `code` char(25) NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL DEFAULT '',
  `period_1` double(12,2) DEFAULT '0.00',
  `sig_period_1` varchar(15) DEFAULT '',
  `period_5` double(12,2) DEFAULT '0.00',
  `sig_period_5` varchar(15) DEFAULT '',
  `period_10` double(12,2) DEFAULT '0.00',
  `sig_period_10` varchar(15) DEFAULT '',
  `period_20` double(12,2) DEFAULT '0.00',
  `sig_period_20` varchar(15) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `foreign_nbs`
--

CREATE TABLE `foreign_nbs` (
  `code` char(25) NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL DEFAULT '',
  `period_1` double(16,4) DEFAULT '0.0000',
  `sig_period_1` varchar(15) DEFAULT '',
  `period_5` double(16,4) DEFAULT '0.0000',
  `sig_period_5` varchar(15) DEFAULT '',
  `period_10` double(16,4) DEFAULT '0.0000',
  `sig_period_10` varchar(15) DEFAULT '',
  `period_20` double(16,4) DEFAULT '0.0000',
  `sig_period_20` varchar(15) DEFAULT '',
  `ss_period_1` double(16,4) DEFAULT '0.0000',
  `ss_sig_period_1` varchar(15) DEFAULT NULL,
  `ss_period_5` double(16,4) DEFAULT '0.0000',
  `ss_sig_period_5` varchar(15) DEFAULT NULL,
  `ss_period_10` double(16,4) DEFAULT '0.0000',
  `ss_sig_period_10` varchar(15) DEFAULT NULL,
  `ss_period_20` double(16,4) DEFAULT '0.0000',
  `ss_sig_period_20` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `moving_averages`
--

CREATE TABLE `moving_averages` (
  `code` char(25) NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL DEFAULT '',
  `ma_5` double(12,2) DEFAULT '0.00',
  `sig_ma_5` varchar(15) DEFAULT '',
  `ma_10` double(12,2) DEFAULT '0.00',
  `sig_ma_10` varchar(15) DEFAULT '',
  `ma_20` double(12,2) DEFAULT '0.00',
  `sig_ma_20` varchar(15) DEFAULT '',
  `ma_50` double(12,2) DEFAULT '0.00',
  `sig_ma_50` varchar(15) DEFAULT '',
  `ma_100` double(12,2) DEFAULT '0.00',
  `sig_ma_100` varchar(15) DEFAULT '',
  `ma_200` double(12,2) DEFAULT '0.00',
  `sig_ma_200` varchar(15) DEFAULT '',
  `ema_5` double(12,2) DEFAULT '0.00',
  `sig_ema_5` varchar(15) DEFAULT '',
  `ema_10` double(12,2) DEFAULT '0.00',
  `sig_ema_10` varchar(15) DEFAULT '',
  `ema_20` double(12,2) DEFAULT '0.00',
  `sig_ema_20` varchar(15) DEFAULT '',
  `ema_50` double(12,2) DEFAULT '0.00',
  `sig_ema_50` varchar(15) DEFAULT '',
  `ema_100` double(12,2) DEFAULT '0.00',
  `sig_ema_100` varchar(15) DEFAULT '',
  `ema_200` double(12,2) DEFAULT '0.00',
  `sig_ema_200` varchar(15) DEFAULT '',
  `ema_30` double(12,2) DEFAULT '0.00',
  `sig_ema_30` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `code` char(25) NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL DEFAULT '',
  `codename` varchar(100) DEFAULT '',
  `open` double(18,0) DEFAULT '0',
  `high` double(18,0) DEFAULT '0',
  `low` double(18,0) DEFAULT '0',
  `prev_close` double(18,0) DEFAULT '0',
  `last` double(18,0) DEFAULT '0',
  `avgprice` double(18,0) DEFAULT '0',
  `chg` double(18,2) DEFAULT '0.00',
  `tvol` double(18,0) DEFAULT '0',
  `tval` double(18,2) DEFAULT '0.00',
  `tfreq` double(12,0) DEFAULT '0',
  `prev_vol` double(18,0) DEFAULT '0',
  `avg_val_30` double(18,2) DEFAULT '0.00',
  `Sector` varchar(50) DEFAULT '',
  `Industry` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `technical_indicators`
--

CREATE TABLE `technical_indicators` (
  `code` char(25) NOT NULL DEFAULT '',
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL DEFAULT '',
  `rsi_14` double(12,2) DEFAULT '0.00',
  `sig_rsi_14` varchar(15) DEFAULT '',
  `sto_5_3` double(12,2) DEFAULT '0.00',
  `sig_sto_5_3` varchar(15) DEFAULT '',
  `sto_rsi_14` double(12,2) DEFAULT '0.00',
  `sig_sto_rsi_14` varchar(15) DEFAULT '',
  `macd_12_26` double(12,2) DEFAULT '0.00',
  `sig_macd_12_26` varchar(15) DEFAULT '',
  `adx_14` double(12,2) DEFAULT '0.00',
  `sig_adx_14` varchar(15) DEFAULT '',
  `cci_14` double(12,2) DEFAULT '0.00',
  `sig_cci_14` varchar(15) DEFAULT '',
  `atr_14` double(12,2) DEFAULT '0.00',
  `sig_atr_14` varchar(15) DEFAULT '',
  `obv_14` double(18,0) DEFAULT '0',
  `sig_obv_14` varchar(15) DEFAULT '',
  `uo` double(12,2) DEFAULT '0.00',
  `sig_uo` varchar(15) DEFAULT '',
  `mfi_14` double(12,2) DEFAULT NULL,
  `sig_mfi_14` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `trading_system`
--

CREATE TABLE `trading_system` (
  `code` char(25) NOT NULL,
  `lastupdate` datetime DEFAULT '0000-00-00 00:00:00',
  `timeframe` char(10) NOT NULL,
  `last` double(18,4) DEFAULT '0.0000',
  `prev_close` double(18,4) DEFAULT '0.0000',
  `chg` double(18,4) DEFAULT '0.0000',
  `tsl` double(18,4) DEFAULT '0.0000',
  `fractal_up` double(18,4) DEFAULT '0.0000',
  `jaw` double(18,4) DEFAULT '0.0000',
  `ma_30` double(18,4) DEFAULT '0.0000',
  `nbss` double(18,2) DEFAULT '0.00',
  `prev_nbss` double(18,2) DEFAULT '0.00',
  `value` double(18,2) DEFAULT '0.00',
  `avg_value` double(18,2) DEFAULT '0.00',
  `sto` double(18,2) DEFAULT '0.00',
  `prev_sto` double(18,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `trx_smartwatchlist`
--

CREATE TABLE `trx_smartwatchlist` (
  `id` int NOT NULL,
  `kode_user` varchar(20) NOT NULL,
  `code` char(25) NOT NULL,
  `timeframe` char(10) NOT NULL,
  `last_update` datetime NOT NULL,
  `close` double(18,0) NOT NULL,
  `dsl` double(12,0) NOT NULL,
  `pivot_r2` double(12,0) NOT NULL,
  `sig_dsl` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tr_smartwatchlist`
--

CREATE TABLE `tr_smartwatchlist` (
  `id` int NOT NULL,
  `kode_user` varchar(20) NOT NULL,
  `code` char(25) NOT NULL,
  `timeframe` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_krips`
--
ALTER TABLE `data_krips`
  ADD PRIMARY KEY (`code`,`lastupdate`) USING BTREE,
  ADD KEY `code` (`code`) USING BTREE;

--
-- Indexes for table `data_pasar`
--
ALTER TABLE `data_pasar`
  ADD PRIMARY KEY (`code`,`timeframe`) USING BTREE,
  ADD KEY `code` (`code`) USING BTREE;

--
-- Indexes for table `effective_value`
--
ALTER TABLE `effective_value`
  ADD PRIMARY KEY (`code`,`timeframe`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `foreign_nbs`
--
ALTER TABLE `foreign_nbs`
  ADD PRIMARY KEY (`code`,`timeframe`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `moving_averages`
--
ALTER TABLE `moving_averages`
  ADD PRIMARY KEY (`code`,`timeframe`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`code`,`timeframe`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `technical_indicators`
--
ALTER TABLE `technical_indicators`
  ADD PRIMARY KEY (`code`,`timeframe`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `trading_system`
--
ALTER TABLE `trading_system`
  ADD PRIMARY KEY (`code`,`timeframe`) USING BTREE,
  ADD KEY `code` (`code`) USING BTREE;

--
-- Indexes for table `trx_smartwatchlist`
--
ALTER TABLE `trx_smartwatchlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_smartwatchlist`
--
ALTER TABLE `tr_smartwatchlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trx_smartwatchlist`
--
ALTER TABLE `trx_smartwatchlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_smartwatchlist`
--
ALTER TABLE `tr_smartwatchlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
