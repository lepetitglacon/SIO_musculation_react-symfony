<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503180550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_boisson (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_F85F5A1E76C50E4A (proprietaire_id), INDEX IDX_F85F5A1E734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_boisson ADD CONSTRAINT FK_F85F5A1E76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES Utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire_boisson ADD CONSTRAINT FK_F85F5A1E734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE commentaire_atelier CHANGE proprietaire_id proprietaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE sequencetheorique DROP FOREIGN KEY FK_3107E7DE76C50E4A');
        $this->addSql('DROP INDEX IDX_3107E7DE76C50E4A ON sequencetheorique');
        $this->addSql('ALTER TABLE sequencetheorique DROP proprietaire_id, DROP partage');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentaire_boisson');
        $this->addSql('ALTER TABLE commentaire_atelier CHANGE proprietaire_id proprietaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sequencetheorique ADD proprietaire_id INT DEFAULT NULL, ADD partage TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE sequencetheorique ADD CONSTRAINT FK_3107E7DE76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_3107E7DE76C50E4A ON sequencetheorique (proprietaire_id)');
    }
}
