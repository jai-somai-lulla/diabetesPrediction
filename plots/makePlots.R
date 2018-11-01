raw=read.csv("diabetes.csv")
only=raw[,-9]
for(n in names(only)){
file=trimws(paste(trimws(n),".png"))
png(file)
ftext=paste(n,"~Outcome")
f=as.formula(ftext)
boxplot(f,raw,xlab="Outcome",ylab=n,col=rainbow(2))
dev.off()
}
