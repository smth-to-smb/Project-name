pipeline {
  environment {
     QODANA_TOKEN= credentials('qodana-token')
     QODANA_REMOTE_URL="ssh://git.git"
     QODANA_BRANCH="${GIT_BRANCH}"
     QODANA_REVISION="${GIT_COMMIT}"
  }
     agent {
        docker {
            args '''
                -v https://github.com/smth-to-smb/rate-informer:/data/project
                --entrypoint=""
            '''
            image 'jetbrains/qodana-php:2022.3-eap'
        }
    }

    stages {
        stage('Qodana') {
            steps {
                sh "qodana --project-dir=/data/project"
            }
        }
    }
}
