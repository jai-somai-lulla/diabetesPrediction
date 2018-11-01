#Dtree
library(caTools)
library(rpart)
library(rpart.plot)

args <- commandArgs(TRUE)

if(!file.exists("dtree1.rda")) {
  library(caret)
  raw=read.csv("diabetes.csv")
  raw$Outcome=sapply(raw$Outcome,as.factor)
  for(i in 2:8){
    (raw[which(raw[,i]==0),i]=NA)
  }
  raw$Outcome=sapply(raw$Outcome,as.factor)
  bagged=preProcess(raw,method="bagImpute")
  bagged=predict(bagged,raw)
  raw=bagged   
  index=sample(nrow(raw),nrow(raw)*0.75)
  train=raw[index,]
  test=raw[-index,]
  model=rpart(train$Outcome~.,
            data=train,
            method="class")
  #rpart.plot(fit)
  pred=predict(model,newdata = test,type = "class")
  cm1=table(test$Outcome,pred)
  result1=confusionMatrix(pred,test$Outcome)
  result1
  
  
  tx=table(test$Outcome,pred)
  #print(confusionMatrix(tx))
  save(model, file = "dtree1.rda")
}else{
  load("dtree1.rda")   
}

if (length(args)==8) {
  raw=read.csv("diabetes.csv")  
  #x = as.data.frame(t(c(2,59,56,56,56,2,65,5)))

  x = as.data.frame(t(as.numeric(as.vector(args))))
  names(x)=names(raw[,(1:8)])  
  ans=predict(model,x)
  p=ans[1]
  names(p)=c(" ")
 
  #prob=predict(model,x,type="raw")
  print(p) 
}else{
  print("Insufficinct Input")
}
