library("e1071")
library("randomForest")
library("caret")
args <- commandArgs(TRUE)
g1 <- as.double(args[1])
g2 <- as.double(args[2])

#print((g1+g2)[1])




if(!file.exists("rdfo.rda")) {
  
  #NAIVE BAYES BLINDX 0.6510417
  raw=read.csv("diabetes.csv")
  #without cata 0.7292
  raw$Outcome=sapply(raw$Outcome,as.factor)
  index=sample(nrow(raw),nrow(raw)*0.75)
  train=raw[index,]
  test=raw[-index,]
  model=randomForest(Outcome~.,train)
  pred=predict(model,test)
  tx=table(test$Outcome,pred)
  #print(confusionMatrix(tx))
  save(tx, file = "random.rda")
  save(model, file = "rdfo.rda")
}else{
  load("rdfo.rda")   
  load("random.rda")
  #print(tx)
  #print("Load Successful")
}

if (length(args)==8) {
  raw=read.csv("diabetes.csv")  
  x = as.data.frame(t(as.numeric(as.vector(args))))
  names(x)=names(raw[,(1:8)])  
  ans=predict(model,x)
  p=as.numeric(as.character(ans))
  names(p)=c(" ")  
  #prob=predict(model,x,type="raw")
  print(p)
}else{
  print("Insufficinct Input")}

