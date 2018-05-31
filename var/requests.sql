--query for deleting images
DELETE FROM images WHERE id = 1

--query for selecting images with owner
SELECT * FROM images
LEFT JOIN users on images.user_id = users.id
LIMIT 0, 9

--query for adding images
INSERT INTO images(id, image_path, thumbnail_path, description, author_name, created_at, user_id)
VALUES(NULL, 'image_path', 'thumpnail_path', 'description', 'author name', CURRENT_TIMESTAMP(), 1)