<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925142543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, goal_list_id INT NOT NULL, is_done TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FCDCEB2E4C851477 (goal_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goal_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, language_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5AF8BDBAA76ED395 (user_id), INDEX IDX_5AF8BDBA82F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, iso639 VARCHAR(3) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_language (user_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_345695B5A76ED395 (user_id), INDEX IDX_345695B582F1BAF4 (language_id), PRIMARY KEY(user_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, list_id INT NOT NULL, original VARCHAR(255) NOT NULL, en_translation VARCHAR(255) NOT NULL, INDEX IDX_C3F175115FB14BA7 (level_id), INDEX IDX_C3F175113DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_level (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, language_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4C5DFBF5A76ED395 (user_id), INDEX IDX_4C5DFBF582F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E4C851477 FOREIGN KEY (goal_list_id) REFERENCES goal_list (id)');
        $this->addSql('ALTER TABLE goal_list ADD CONSTRAINT FK_5AF8BDBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE goal_list ADD CONSTRAINT FK_5AF8BDBA82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F175115FB14BA7 FOREIGN KEY (level_id) REFERENCES word_level (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F175113DAE168B FOREIGN KEY (list_id) REFERENCES word_list (id)');
        $this->addSql('ALTER TABLE word_list ADD CONSTRAINT FK_4C5DFBF5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE word_list ADD CONSTRAINT FK_4C5DFBF582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E4C851477');
        $this->addSql('ALTER TABLE goal_list DROP FOREIGN KEY FK_5AF8BDBAA76ED395');
        $this->addSql('ALTER TABLE goal_list DROP FOREIGN KEY FK_5AF8BDBA82F1BAF4');
        $this->addSql('ALTER TABLE user_language DROP FOREIGN KEY FK_345695B5A76ED395');
        $this->addSql('ALTER TABLE user_language DROP FOREIGN KEY FK_345695B582F1BAF4');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F175115FB14BA7');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F175113DAE168B');
        $this->addSql('ALTER TABLE word_list DROP FOREIGN KEY FK_4C5DFBF5A76ED395');
        $this->addSql('ALTER TABLE word_list DROP FOREIGN KEY FK_4C5DFBF582F1BAF4');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE goal_list');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_language');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE word_level');
        $this->addSql('DROP TABLE word_list');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
