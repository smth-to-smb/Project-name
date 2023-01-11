pipeline {
  agent any
  environment {
     QODANA_BRANCH="${GIT_BRANCH}"
     QODANA_REVISION="${GIT_COMMIT}"
  }
  stages {
    stage('ShowBranch'){
      steps{
        sh 'echo $QODANA_BRANCH'
        sh 'echo $QODANA_REVISION'
      }
    }
  }
}
