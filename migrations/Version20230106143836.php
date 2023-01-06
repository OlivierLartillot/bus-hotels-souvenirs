<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106143836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_bus DROP FOREIGN KEY FK_F7B9F2158034E980');
        $this->addSql('DROP INDEX IDX_F7B9F2158034E980 ON info_bus');
        $this->addSql('ALTER TABLE info_bus DROP infos_client_id');
        $this->addSql('ALTER TABLE infos_client ADD bus_id INT NOT NULL');
        $this->addSql('ALTER TABLE infos_client ADD CONSTRAINT FK_126BBD512546731D FOREIGN KEY (bus_id) REFERENCES info_bus (id)');
        $this->addSql('CREATE INDEX IDX_126BBD512546731D ON infos_client (bus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infos_client DROP FOREIGN KEY FK_126BBD512546731D');
        $this->addSql('DROP INDEX IDX_126BBD512546731D ON infos_client');
        $this->addSql('ALTER TABLE infos_client DROP bus_id');
        $this->addSql('ALTER TABLE info_bus ADD infos_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE info_bus ADD CONSTRAINT FK_F7B9F2158034E980 FOREIGN KEY (infos_client_id) REFERENCES infos_client (id)');
        $this->addSql('CREATE INDEX IDX_F7B9F2158034E980 ON info_bus (infos_client_id)');
    }
}
