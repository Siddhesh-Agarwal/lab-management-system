INSERT INTO users (
        id,
        name,
        email,
        email_verified_at,
        password,
        role,
        labname,
        remember_token,
        created_at,
        updated_at
    )
VALUES (
        id: INTEGER,
        'name:varchar',
        'email:varchar',
        'email_verified_at:datetime',
        'password:varchar',
        'role:varchar',
        'labname:varchar',
        'remember_token:varchar',
        'created_at:datetime',
        'updated_at:datetime'
    );
