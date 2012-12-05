Data Structure
--------------

**relationship**
- user m-m entry
- entry 1-m version
- entry 1-m comment

**user**
- name
- email
- need_password
- password
- attend_time

**entry**
- create_time
- last_version

**version**
- entry
- editor
- title
- text
- reason
- time

**comment**
- user
- text
- time
