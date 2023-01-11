pipeline {
  agent any
  environment {
     QODANA_BRANCH="${GIT_BRANCH}"
  }
  stages {
    stage('ShowBranch'){
      steps{
        sh 'echo $QODANA_BRANCH'
      }
    }
  }
}
