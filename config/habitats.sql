INSERT INTO image (image_data) VALUES
(pg_read_binary_file('/arcadia/public/images/habitats/savane4.jpg')),
(pg_read_binary_file('/arcadia/public/images/habitats/jungle2.jpg')),
(pg_read_binary_file('/arcadia/public/images/habitats/marais3.jpg'));