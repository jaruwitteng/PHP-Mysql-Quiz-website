<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 9-1</title>
</head>

<body>
<pre>
CREATE TABLE employees(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80),
  gender VARCHAR(10) DEFAULT "female",
  position VARCHAR(30),
  salary INT,
  email VARCHAR(40) UNIQUE,
  birthday DATE
)

<HR>
INSERT INTO employees VALUES

('', 'John', 'male', 'Manager', 50000, 
'john@hotmail.com', '1980-10-20'),

('', 'Jane',DEFAULT(gender),'Accountant', 
30000,'jane@yahoo.com','1985-01-31'),

('','Jill',DEFAULT(gender),'Accountant', 
 25000,'jill@example.com','1988-05-31'),

('','Jack','male','Sales',
30000,'jack@test.com','1990-12-01'),

('','Jenny','female','Sales', 
25000,'janny@hotmail.com','1992-02-14'),

('','Jennifer',DEFAULT(gender),'Secretary', 
20000,'jennifer@gmail.com','1992-10-01'),

('','Jim','male','Programmer',35000, 
'jim@yahoo.com','1980-04-30');

</pre>
</body>
</html>