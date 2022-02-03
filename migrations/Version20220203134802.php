<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203134802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE glasses (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, size INT NOT NULL, shape VARCHAR(255) NOT NULL, price INT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glasses_user (glasses_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EAA90C5897C9FB5E (glasses_id), INDEX IDX_EAA90C58A76ED395 (user_id), PRIMARY KEY(glasses_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE glasses_user ADD CONSTRAINT FK_EAA90C5897C9FB5E FOREIGN KEY (glasses_id) REFERENCES glasses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE glasses_user ADD CONSTRAINT FK_EAA90C58A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE glasses_user DROP FOREIGN KEY FK_EAA90C5897C9FB5E');
        $this->addSql('ALTER TABLE glasses_user DROP FOREIGN KEY FK_EAA90C58A76ED395');
        $this->addSql('DROP TABLE glasses');
        $this->addSql('DROP TABLE glasses_user');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
