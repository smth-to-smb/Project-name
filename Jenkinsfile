pipeline {
  agent any
  environment {
     QODANA_BRANCH="${GIT_BRANCH}"
  }
  stages {
    stage('ShowBranch'){
      sh 'echo $QODANA_BRANCH'
    }
  }
}
