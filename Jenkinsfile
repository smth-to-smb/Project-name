pipeline {
  environment {
     QODANA_TOKEN= credentials('qodana-token')
     QODANA_REMOTE_URL="${GIT_URL}"
     QODANA_BRANCH="${GIT_BRANCH}"
     QODANA_REVISION="${GIT_COMMIT}"
     
  }
     agent {
        docker {
            args '''
                -v /home/anton/Desktop/informer/rate-informer:/data/project
                --entrypoint=""
            '''
            image 'jetbrains/qodana-php:2022.3-eap'
        }
    }

    stages {
        stage('Qodana') {
            steps {
                sh "$QODANA_REMOTE_URL"
                sh "qodana --project-dir=/data/project"
            }
        }
    }
}
