<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220804142645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE printing (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, material_id INT NOT NULL, title VARCHAR(255) NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, default_size DOUBLE PRECISION NOT NULL, default_weight DOUBLE PRECISION NOT NULL, option_size LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_308F6DF312469DE2 (category_id), INDEX IDX_308F6DF3A76ED395 (user_id), INDEX IDX_308F6DF3E308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF3E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE printing');
    }
}
