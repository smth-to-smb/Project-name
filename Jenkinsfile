pipeline {
  agent any
  environment {
     QODANA_BRANCH="${GIT_BRANCH}"
  }
  stage('ShowBranch'){
    sh 'echo $QODANA_BRANCH'
  }
}
