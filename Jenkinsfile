pipeline {
    agent any

    stages {
        stage('Pull Code') {
            steps {
                sh 'git pull origin main'
            }
        }

        stage('Deploy Docker') {
            steps {
                sh 'docker compose up -d --build'
            }
        }

        stage('Clear Laravel Cache') {
            steps {
                sh 'docker exec laravel_app php artisan optimize:clear'
            }
        }
    }
}
