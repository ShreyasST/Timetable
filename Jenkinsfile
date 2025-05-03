pipeline {
    agent any

    environment {
        IMAGE_NAME = 'timetable-generator'
    }

    stages {
        stage('Clone Repo') {
            steps {
                git 'https://github.com/your-username/timetable-project.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    docker.build(IMAGE_NAME)
                }
            }
        }

        stage('Test') {
            steps {
                echo 'No tests implemented yet'
            }
        }

        stage('Push to DockerHub') {
            steps {
                withDockerRegistry([credentialsId: 'dockerhub-creds', url: '']) {
                    script {
                        docker.image(IMAGE_NAME).push('latest')
                    }
                }
            }
        }

        stage('Deploy') {
            steps {
                echo 'Trigger deployment on Render or other host'
            }
        }
    }
}