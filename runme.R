library("e1071")

args <- commandArgs(TRUE)
g1 <- as.double(args[1])
g2 <- as.double(args[2])

#print((g1+g2)[1])




if(!file.exists("naive.rda")) {
library(caret)
#NAIVE BAYES BLINDX 0.6510417
raw=read.csv("diabetes.csv")
#without cata 0.7292
raw$Outcome=sapply(raw$Outcome,as.factor)
index=sample(nrow(raw),nrow(raw)*0.75)
train=raw[index,]
test=raw[-index,]
model=naiveBayes(Outcome~.,train)
pred=predict(model,test)
tx=table(test$Outcome,pred)
#print(confusionMatrix(tx))
save(tx, file = "naiveacc.rda")
save(model, file = "naive.rda")
}else{
load("naive.rda")   
load("naiveacc.rda")
#print(tx)
#print("Load Successful")
}

if (length(args)==8) {
  raw=read.csv("diabetes.csv")  
  x = as.data.frame(t(as.numeric(as.vector(args))))
  names(x)=names(raw[,(1:8)])  
  ans=predict(model,x)
  prob=predict(model,x,type="raw")
   # if(ans==1){
    #    print(paste("Positive ",ans," <br />","Probablity Positive==>",prob[1,1]," <br /> Probablity Negative==>",prob[1,2],"<br />"))
     #   }else{
      #  print(paste("Negative ",ans,"<br />","Probablity Positive==>",prob[1,1]," <br /> Probablity Negative==>",prob[1,2],"<br />"))
       # }
      #print(paste("Probablity Positive==>",prob[1,1]," <br /> Probablity Negative==>",prob[1,2],"<br />"))  
       print(prob[1,1]) 
}else{
print("Insufficinct Input")
}





