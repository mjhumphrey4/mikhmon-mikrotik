pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', 
                url: 'https://github.com/mjhumphrey4/onlifi-mikrotik',
                credentialsId: 'onlifi-mikrotik'
            }
        }
        stage('Sync to Host Server') {
            steps {
                sh '''
                    pwd
                    ls -al
                    rsync -az ./ hum@192.168.0.170:/var/www/mikhmon-mikrotik
                '''
            }
        }
    }
}
