<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106134419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE info_bus (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, infos_client_id INT DEFAULT NULL, hotel VARCHAR(60) NOT NULL, hour TIME NOT NULL, INDEX IDX_F7B9F21564D218E (location_id), INDEX IDX_F7B9F2158034E980 (infos_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infos_client (id INT AUTO_INCREMENT NOT NULL, day DATE NOT NULL, name VARCHAR(255) NOT NULL, number_persons SMALLINT NOT NULL, room_number INT NOT NULL, whats_app_number VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu_de_rdv (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE info_bus ADD CONSTRAINT FK_F7B9F21564D218E FOREIGN KEY (location_id) REFERENCES lieu_de_rdv (id)');
        $this->addSql('ALTER TABLE info_bus ADD CONSTRAINT FK_F7B9F2158034E980 FOREIGN KEY (infos_client_id) REFERENCES infos_client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_bus DROP FOREIGN KEY FK_F7B9F21564D218E');
        $this->addSql('ALTER TABLE info_bus DROP FOREIGN KEY FK_F7B9F2158034E980');
        $this->addSql('DROP TABLE info_bus');
        $this->addSql('DROP TABLE infos_client');
        $this->addSql('DROP TABLE lieu_de_rdv');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
