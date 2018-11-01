for(n in names(raw)){
file=paste(n,"png")
png(file)
ftext=paste(n,"~Outcome")
f=as.formula(ftext)
boxplot(Pregnancies~Outcome,raw,xlab="Outcome",ylab=n,col=rainbow(2))
dev.off()
}
