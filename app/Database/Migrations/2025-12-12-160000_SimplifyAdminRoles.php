    <?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;

    class SimplifyAdminRoles extends Migration
    {
        public function up()
        {
            // Update pendaftaran_atlet status enum to simple version
            $this->db->query("ALTER TABLE pendaftaran_atlet MODIFY COLUMN status ENUM('menunggu_verifikasi_klub', 'menunggu_verifikasi_admin', 'diterima', 'ditolak_klub', 'ditolak_admin') DEFAULT 'menunggu_verifikasi_klub'");

            // Update existing data
            $this->db->query("UPDATE pendaftaran_atlet SET status = 'menunggu_verifikasi_admin' WHERE status = 'menunggu_verifikasi_provinsi'");
            $this->db->query("UPDATE pendaftaran_atlet SET status = 'ditolak_admin' WHERE status = 'ditolak_provinsi'");

            // Update pendaftaran_pelatih status enum to simple version
            $this->db->query("ALTER TABLE pendaftaran_pelatih MODIFY COLUMN status ENUM('menunggu_verifikasi_admin', 'diterima', 'ditolak') DEFAULT 'menunggu_verifikasi_admin'");

            // Update existing data
            $this->db->query("UPDATE pendaftaran_pelatih SET status = 'menunggu_verifikasi_admin' WHERE status = 'menunggu_verifikasi_provinsi'");

            echo "Admin roles simplified successfully!\n";
        }

        public function down()
        {
            // Revert changes
            $this->db->query("ALTER TABLE pendaftaran_atlet MODIFY COLUMN status ENUM('menunggu_verifikasi_klub', 'menunggu_verifikasi_provinsi', 'diterima', 'ditolak_klub', 'ditolak_provinsi') DEFAULT 'menunggu_verifikasi_klub'");
            $this->db->query("ALTER TABLE pendaftaran_pelatih MODIFY COLUMN status ENUM('menunggu_verifikasi_provinsi', 'diterima', 'ditolak') DEFAULT 'menunggu_verifikasi_provinsi'");
        }
    }
