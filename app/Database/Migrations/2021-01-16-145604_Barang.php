<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
	public function up()
   {
      $this->forge->addField([
               'id'          => [
                       'type'           => 'INT',
                       'constraint'     => 5,
                       'unsigned'       => true,
                       'auto_increment' => true,
               ],
               'nama'       => [
                       'type'           => 'VARCHAR',
                       'constraint'     => '255',
               ],
               'harga' => [
                       'type'           => 'INT',
                       'constraint'     => 11,
               ],
               'stok' => [
                       'type'           => 'INT',
                       'constraint'     => 11,
               ],
               'gambar' => [
                       'type'           => 'VARCHAR',
                       'constraint'     => '255',
                       'null'           => true,
               ],
               'created_by' => [
                       'type'           => 'INT',
                       'constraint'     => 11,
               ],
               'created_date' => [
                       'type'           => 'DATETIME',
               ],
               'updated_by' => [
                       'type'           => 'INT',
                       'constraint'     => 11,
                       'null'             => true
               ],
               'updated_date' => [
                       'type'           => 'DATETIME',
                       'null'             => true
               ],
       ]);
       $this->forge->addKey('id', true);
       $this->forge->createTable('barang');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('barang');
   }
}
