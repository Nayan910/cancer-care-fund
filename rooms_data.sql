-- Insert all rooms from the hospital planning document
-- This includes all floors and categories

USE cancer_care_fund;

-- Ground Floor - OPD/Consultation Area
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('Conference Room', 'કોન્ફરન્સ રૂમ', 'Administration', 'Ground Floor', 'Main conference room for meetings and consultations', 2100000, 1),
('Office - 1', 'ઓફિસ - 1', 'Administration', 'Ground Floor', 'Administrative office space', 1100000, 2),
('Office - 2', 'ઓફિસ - 2', 'Administration', 'Ground Floor', 'Administrative office space', 1100000, 3),
('Office - 3', 'ઓફિસ - 3', 'Administration', 'Ground Floor', 'Administrative office space', 2100000, 4),
('Passenger Lift', 'પેસેન્જર લિફ્ટ', 'Infrastructure', 'Ground Floor', 'Elevator for patients and visitors', 1100000, 5),
('File Storage', 'ફાઇલ સ્ટોરેજ', 'Administration', 'Ground Floor', 'Document and file storage area', 1100000, 6),
('Reception Area', 'રિસેપ્શન એરિયા', 'Support', 'Ground Floor', 'Main reception and waiting area', 5100000, 7),
('Doctor Room', 'ડૉક્ટર રૂમ', 'Medical', 'Ground Floor', 'Doctor consultation room', 1100000, 8),
('Doctor Lift', 'ડૉક્ટર લિફ્ટ', 'Infrastructure', 'Ground Floor', 'Dedicated lift for medical staff', 1100000, 9),
('Electrical Room', 'ઇલેક્ટ્રિકલ રૂમ', 'Infrastructure', 'Ground Floor', 'Electrical and power systems room', 1100000, 10),
('Laboratory - Doctor Room', 'લેબોરેટરી - ડૉક્ટર રૂમ', 'Medical', 'Ground Floor', 'Laboratory and doctor consultation space', 1100000, 11),
('Procedure Room - OPD 1', 'પ્રોસીજર રૂમ - ઓપીડી 1', 'Medical', 'Ground Floor', 'Minor procedures and treatment room', 1100000, 12),
('OPD 2', 'ઓપીડી 2', 'Medical', 'Ground Floor', 'Outpatient department consultation', 1100000, 13),
('OPD 3', 'ઓપીડી 3', 'Medical', 'Ground Floor', 'Outpatient department consultation', 1100000, 14);

-- First Floor - Patient Wards (Male)
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('General Patient Ward - Male', 'જનરલ પેશન્ટ વોર્ડ - પુરુષ', 'Patient Ward', 'First Floor', 'General ward for male patients', 10000000, 20),
('Children Ward - 1', 'ચિલ્ડ્રન વોર્ડ - 1', 'Patient Ward', 'First Floor', 'Pediatric care ward', 5100000, 21),
('Isolation Room - 1', 'આયસોલેશન રૂમ - 1', 'Special Care', 'First Floor', 'Isolation room for infectious cases', 1100000, 22),
('Storage Room - First Floor', 'સ્ટોરેજ રૂમ', 'Support', 'First Floor', 'Medical supplies storage', 1100000, 23),
('Reception Area - First Floor', 'રિસેપ્શન એરિયા', 'Support', 'First Floor', 'Floor reception and nurse station', 2100000, 24),
('Doctor Room - First Floor', 'ડૉક્ટર રૂમ', 'Medical', 'First Floor', 'Doctor on-duty room', 1100000, 25),
('Isolation Room - 2', 'આયસોલેશન રૂમ - 2', 'Special Care', 'First Floor', 'Additional isolation room', 1100000, 26),
('Children Ward - 2', 'ચિલ્ડ્રન વોર્ડ - 2', 'Patient Ward', 'First Floor', 'Additional pediatric care ward', 5100000, 27),
('General Patient Ward - Female', 'જનરલ પેશન્ટ વોર્ડ - મહિલા', 'Patient Ward', 'First Floor', 'General ward for female patients', 10000000, 28);

-- Second Floor - Patient Wards (Additional)
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('General Patient Ward - Male (2F)', 'જનરલ પેશન્ટ વોર્ડ - પુરુષ', 'Patient Ward', 'Second Floor', 'Additional general ward for male patients', 10000000, 30),
('Children Ward - 1 (2F)', 'ચિલ્ડ્રન વોર્ડ - 1', 'Patient Ward', 'Second Floor', 'Pediatric care ward', 5100000, 31),
('Isolation Room - 1 (2F)', 'આયસોલેશન રૂમ - 1', 'Special Care', 'Second Floor', 'Isolation room', 1100000, 32),
('Storage Room - Second Floor', 'સ્ટોરેજ રૂમ', 'Support', 'Second Floor', 'Medical supplies storage', 1100000, 33),
('Reception Area - Second Floor', 'રિસેપ્શન એરિયા', 'Support', 'Second Floor', 'Floor reception', 2100000, 34),
('Doctor Room - Second Floor', 'ડૉક્ટર રૂમ', 'Medical', 'Second Floor', 'Doctor consultation room', 1100000, 35),
('Isolation Room - 2 (2F)', 'આયસોલેશન રૂમ - 2', 'Special Care', 'Second Floor', 'Additional isolation room', 1100000, 36),
('Children Ward - 2 (2F)', 'ચિલ્ડ્રન વોર્ડ - 2', 'Patient Ward', 'Second Floor', 'Pediatric care ward', 5100000, 37),
('General Patient Ward - Female (2F)', 'જનરલ પેશન્ટ વોર્ડ - મહિલા', 'Patient Ward', 'Second Floor', 'General ward for female patients', 10000000, 38);

-- Third Floor - Premium Rooms & ICU
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('Super Deluxe Room - 1', 'સુપર ડિલક્સ રૂમ - 1', 'Premium Care', 'Third Floor', 'Premium patient room with advanced facilities', 2100000, 40),
('Super Deluxe Room - 2', 'સુપર ડિલક્સ રૂમ - 2', 'Premium Care', 'Third Floor', 'Premium patient room', 2100000, 41),
('Deluxe Room - 1', 'ડિલક્સ રૂમ - 1', 'Premium Care', 'Third Floor', 'Deluxe patient room', 2100000, 42),
('Deluxe Room - 2', 'ડિલક્સ રૂમ - 2', 'Premium Care', 'Third Floor', 'Deluxe patient room', 2100000, 43),
('Deluxe Room - 3', 'ડિલક્સ રૂમ - 3', 'Premium Care', 'Third Floor', 'Deluxe patient room', 2100000, 44),
('Deluxe Room - 4', 'ડિલક્સ રૂમ - 4', 'Premium Care', 'Third Floor', 'Deluxe patient room', 1100000, 45),
('Deluxe Room - 5', 'ડિલક્સ રૂમ - 5', 'Premium Care', 'Third Floor', 'Deluxe patient room', 1100000, 46),
('Deluxe Room - 6', 'ડિલક્સ રૂમ - 6', 'Premium Care', 'Third Floor', 'Deluxe patient room', 1100000, 47),
('Isolation Room (3F)', 'આયસોલેશન રૂમ', 'Special Care', 'Third Floor', 'Isolation room with ICU backup', 2100000, 48),
('ICU Room', 'આઇસીયુ રૂમ', 'Critical Care', 'Third Floor', 'Intensive Care Unit', 2100000, 49),
('OT / Procedure Room', 'ઓટી / પ્રોસીજર રૂમ', 'Medical', 'Third Floor', 'Operation theater and procedure room', 2100000, 50),
('File Storage (3F)', 'ફાઇલ સ્ટોરેજ રૂમ', 'Support', 'Third Floor', 'Medical records storage', 2100000, 51),
('Reception Area (3F)', 'રિસેપ્શન એરિયા', 'Support', 'Third Floor', 'Floor reception', 2100000, 52),
('Doctor Room (3F)', 'ડૉક્ટર રૂમ', 'Medical', 'Third Floor', 'Doctor consultation and on-call room', 2100000, 53);

-- Fourth Floor - Support & Therapy
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('Theater Hall', 'થિયેટર હોલ', 'Support', 'Fourth Floor', 'Multi-purpose hall for events and therapy', 5100000, 60),
('Prayer-Therapy-Conference Hall', 'પ્રાર્થના-થેરાપી-કોન્ફરન્સ હોલ', 'Support', 'Fourth Floor', 'Multi-faith prayer and therapy space', 5100000, 61),
('Ball Room', 'બોલ રૂમ', 'Support', 'Fourth Floor', 'Recreation and physical therapy space', 1100000, 62),
('File Storage (4F)', 'ફાઇલ સ્ટોરેજ રૂમ', 'Support', 'Fourth Floor', 'Storage area', 1100000, 63),
('Reception Area (4F)', 'રિસેપ્શન એરિયા', 'Support', 'Fourth Floor', 'Floor reception', 1100000, 64),
('Doctor Room (4F)', 'ડૉક્ટર રૂમ', 'Medical', 'Fourth Floor', 'Doctor room', 1100000, 65),
('Multi-Purpose Room', 'મલ્ટી પર્પઝ રૂમ', 'Support', 'Fourth Floor', 'Flexible use space', 1100000, 66),
('Game Zone', 'ગેમ ઝોન', 'Support', 'Fourth Floor', 'Recreation area for patients and families', 2100000, 67),
('Ayurveda-Panchkarma Hall', 'આયુર્વેદ-પંચકર્મ હોલ', 'Therapy', 'Fourth Floor', 'Traditional medicine and therapy center', 5100000, 68),
('Physiotherapy Hall', 'ફિઝીયોથેરાપી હોલ', 'Therapy', 'Fourth Floor', 'Physical rehabilitation center', 5100000, 69);

-- External/Campus Areas
INSERT INTO rooms (name_en, name_gu, category, floor, description, required_amount, display_order) VALUES
('Dining Hall', 'ભોજન શાળા', 'Campus', 'Campus', 'Community dining facility for patients and families', 2500000, 70),
('Kitchen', 'સેવા કુટીર', 'Campus', 'Campus', 'Central kitchen and food preparation', 1100000, 71),
('Cow Shelter (Gau Shala)', 'ગૌ શાળા', 'Campus', 'Campus', 'Traditional cow shelter and dairy', 5100000, 72),
('Yoga Hall', 'યજ્ઞ શાળા', 'Wellness', 'Campus', 'Yoga and meditation center', 2500000, 73),
('Children Garden', 'ચિલ્ડ્રન ગાર્ડન', 'Campus', 'Campus', 'Therapeutic garden for children', 1100000, 74),
('Multi-Faith Prayer Hall', 'સર્વ ધર્મ પ્રાર્થના હોલ', 'Spiritual', 'Campus', 'Prayer space for all faiths', 2500000, 75);

-- Update total amounts in settings
UPDATE settings SET setting_value = '125000000' WHERE setting_key = 'goal_amount';
