DROP DATABASE IF EXISTS RestaurantDB_SMSJ;
CREATE DATABASE IF NOT EXISTS RestaurantDB_SMSJ;

USE RestaurantDB_SMSJ;

CREATE TABLE Customer 
(
    customerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE Booking
(
    bookingID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID INT NOT NULL,
    date DATETIME NOT NULL,
    numberOfPeople INT NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer (customerID) 
);

CREATE TABLE RestaurantTable
(
    restaurantTableID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tableNumber INT NOT NULL, 
    seatsAvailable INT NOT NULL
);

CREATE TABLE BookingTableDetails 
(
    bookingID INT NOT NULL,
    tableRecID INT NOT NULL,
    FOREIGN key (bookingID) REFERENCES Booking (bookingID),
    FOREIGN key (tableRecID) REFERENCES RestaurantTable (restaurantTableID),
    PRIMARY KEY(bookingID, tableRecID)
);


INSERT INTO Customer (firstname, lastname, phone, email) VALUES
('Aguistin', 'Baverstock', '647-565-4249', 'abaverstock0@devhub.com'),
('Emilie', 'Bentinck', '373-360-2549', 'ebentinck1@theglobeandmail.com'),
('Merrielle', 'Jiracek', '213-924-2985', 'mjiracek2@utexas.edu'),
('Bernie', 'Swarbrick', '321-836-9666', 'bswarbrick3@ucoz.ru'),
('Hildagard', 'Rowney', '807-439-9867', 'hrowney4@shareasale.com');

INSERT INTO Booking (customerID, date, numberOfPeople) VALUES 
(1, '2020-05-10 18:00:00', 2),
(2, '2020-05-10 18:00:00', 10),
(3, '2020-05-10 19:00:00', 5),
(4, '2020-05-10 20:00:00', 2),
(5, '2020-05-10 20:00:00', 9);

INSERT INTO RestaurantTable (tableNumber, seatsAvailable) VALUES
(1, 2),
(2, 4),
(3, 4),
(4, 6),
(5, 10);


INSERT INTO BookingTableDetails (bookingID, tableRecID) VALUES
(1, 1), -- 2 ppl table booking 
(2, 5), -- 10 ppl table booking
(3, 4), -- 5 ppl table booking 
(4, 1), -- 2 ppl table booking
(5, 5); -- 10 ppl table booking


-- (a) - Get a list of all tables in the restaurant (overview for the front-end)
SELECT * FROM RestaurantTable;


-- (b) - Get a list of all bookings for a given customer (when they arrive at the restaurant)ordered by date
SELECT b.bookingID, b.date, b.numberOfPeople, rt.tableNumber, rt.seatsAvailable, c.phone, c.firstName, c.lastName
FROM Booking b, BookingTableDetails btd, RestaurantTable rt, Customer c 
WHERE b.customerID = c.customerID 
AND b.bookingID = btd.bookingID
AND btd.tableRecID = rt.restaurantTableID
-- AND c.phone = '647-565-4249'
AND c.firstname = 'Aguistin'
AND c.lastname = 'Baverstock'
ORDER BY Date ASC;
-- Gets booking details (id, date, numberOfPeople, tablenumber) for a given customer based on phone or name


-- (c) - Get a list of all bookings for a given tableID, including the customers for a specific date
SELECT b.bookingID, b.date, b.numberOfPeople, rt.tableNumber, rt.seatsAvailable, c.phone, c.firstName, c.lastName
FROM Booking b, BookingTableDetails btd, RestaurantTable rt, Customer c 
WHERE b.customerID = c.customerID 
AND b.bookingID = btd.bookingID
AND btd.tableRecID = rt.restaurantTableID
AND rt.tableNumber = 5
AND date(b.date) = '2020-05-10'