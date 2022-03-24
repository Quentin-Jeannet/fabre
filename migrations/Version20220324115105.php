<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324115105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE afvim_session');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, ADD is_attending_meeting TINYINT(1) DEFAULT NULL, ADD is_remotely TINYINT(1) DEFAULT NULL, ADD is_need_train TINYINT(1) DEFAULT NULL, ADD is_need_flight TINYINT(1) DEFAULT NULL, ADD is_need_hotel TINYINT(1) DEFAULT NULL, ADD train_station VARCHAR(255) DEFAULT NULL, ADD airport VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE afvim_session (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ses_vimeo_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ses_date DATETIME NOT NULL, ses_start_time TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE programs');
        $this->addSql('ALTER TABLE user DROP is_verified, DROP is_attending_meeting, DROP is_remotely, DROP is_need_train, DROP is_need_flight, DROP is_need_hotel, DROP train_station, DROP airport');
    }
}
