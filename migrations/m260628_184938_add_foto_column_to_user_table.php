<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m260628_184938_add_foto_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    // Menambahkan kolom 'foto' ke tabel 'user'
    $this->addColumn('user', 'foto', $this->string(255)->null()->after('email'));
}

public function safeDown()
{
    // Menghapus kembali jika diperlukan rollback
    $this->dropColumn('user', 'foto');
}
}
