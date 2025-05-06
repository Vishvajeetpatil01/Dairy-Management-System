SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 INSERT INTO `login` (`user`, `password`) VALUES
 ('admin', '123456');

INSERT INTO `customer` (`id`, `name`, `address`,`mobile`,`mtype`) VALUES
(1, 'Ram', 'SIN', '9876543211', 'Buffalo'),
(2, 'Sham', 'SIN', '9876543223', 'Cow');


--Table structure for table `bratechart`

CREATE TABLE IF NOT EXISTS `brate` (
  `bfat` double NOT NULL,
  `bsnf` double NOT NULL,
  `brate` double NOT NULL,
  PRIMARY KEY (`bfat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bratechart`
--

INSERT INTO `brate` (`bfat`,`bsnf`,`brate`) VALUES
(6.1, 8.9, 30);


--Table structure for table `cratechart`

CREATE TABLE IF NOT EXISTS `crate` (
  `cfat` double NOT NULL,
  `csnf` double NOT NULL,
  `crate` double NOT NULL,
  PRIMARY KEY (`cfat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `bratechart`
--

INSERT INTO `crate` (`cfat`, `csnf`, `crate`) VALUES
(5.1, 7.5, 25);


CREATE TABLE IF NOT EXISTS `ctime` (
  `cdate` date NOT  NULL,
  `csession` varchar(20) NOT NULL,
  PRIMARY KEY (`cdate`,`csession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `ctime` (`cdate`, `csession`) VALUES
('2017-10-30', 'Evening'),
('2017-11-30', 'Evening');

-- Collection table

CREATE TABLE IF NOT EXISTS `collection` (
  `cdate` date NOT NULL,
  `csession` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `mtype` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `fat` double NOT NULL,
  `snf` double NOT NULL,
  `rate` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`,`mtype`),
  FOREIGN KEY (`cdate`,`csession`)
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `collection` (`cdate`, `csession`, `id`, `mtype`, `qty`, `fat`,`snf`, `rate`, `total`) VALUES
('2017-10-30', 'Evening', 1, 'Buffalo', 10, 6.1, 8.9, 30, 300),
('2017-11-30', 'Evening', 2, 'Cow', 10, 5.1, 7.5, 25, 250);


CREATE TABLE IF NOT EXISTS `totalcollectionb` (
  `cdate` date NOT  NULL,
  `csession` varchar(20) NOT NULL,
  `totalqtyb` double NOT NULL,
  `totalrateb` double NOT NULL,
  FOREIGN KEY (`cdate`,`csession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `totalcollectionb` (`cdate`, `csession`, `toatalqtyb`,`totalrateb`) VALUES
('2017-10-30', 'Evening', 10, 300);


CREATE TABLE IF NOT EXISTS `totalcollectionc` (
  `cdate` date NOT  NULL,
  `csession` varchar(20) NOT NULL,
  `totalqtyc` double NOT NULL,
  `totalratec` double NOT NULL,
  FOREIGN KEY (`cdate`,`csession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `totalcollectionc` (`cdate`, `csession`, `toatalqtyb`,`totalrateb`) VALUES
('2017-11-30', 'Evening', 10, 250);


CREATE TABLE date_session (
    date DATE NOT NULL,
    session VARCHAR(20) NOT NULL
);

CREATE TABLE collectionreport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cdate DATE NOT NULL,
    csession VARCHAR(255) NOT NULL,
    mtype VARCHAR(50) NOT NULL,
    fat DECIMAL(5, 2) NOT NULL,
    snf DECIMAL(5, 2) NOT NULL,
    qty DECIMAL(10, 2) NOT NULL,
    rate DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL
);

CREATE TABLE emi (
    customer_id INT,
    emi_amount DECIMAL(10, 2),
    due_date DATE,
    payment_date DATE,
    payment_status VARCHAR(20),
    FOREIGN KEY (customer_id) REFERENCES loan(id)
);

CREATE TABLE bfr (
    id INT PRIMARY KEY,
    fat_rate DECIMAL(10, 2) NOT NULL
);

CREATE TABLE cfr (
    id INT PRIMARY KEY,
    fat_rate DECIMAL(10, 2) NOT NULL
);
