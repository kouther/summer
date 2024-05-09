<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229195906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE university_name university_name VARCHAR(255) DEFAULT NULL, CHANGE interesrt_course interesrt_course JSON DEFAULT NULL, CHANGE payment payment VARCHAR(1000) DEFAULT NULL, CHANGE payment_date payment_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE firstname firstname VARCHAR(255) DEFAULT \'NULL\', CHANGE lastname lastname VARCHAR(255) DEFAULT \'NULL\', CHANGE university_name university_name VARCHAR(255) DEFAULT \'NULL\', CHANGE interesrt_course interesrt_course LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE payment payment VARCHAR(1000) DEFAULT \'NULL\', CHANGE payment_date payment_date DATE DEFAULT \'NULL\'');
    }
}
