from fastapi import FastAPI
from transformers import AutoModelForCausalLM, AutoTokenizer, pipeline
import torch

app = FastAPI(title="AI-Server API", version="1.0.0.1")

# Beispiel: Modell laden (hier T5 als Platzhalter)
model_name = "t5-small"
tokenizer = AutoTokenizer.from_pretrained(model_name)
model = AutoModelForCausalLM.from_pretrained(model_name, torch_dtype=torch.float16)
ai_pipeline = pipeline("text2text-generation", model=model, tokenizer=tokenizer)

@app.get("/analyze")
def analyze(text: str):
    result = ai_pipeline(text, max_length=100)
    return {"response": result[0]['generated_text']}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)
