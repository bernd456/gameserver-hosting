from transformers import AutoTokenizer, AutoModelForSeq2SeqLM, Trainer, TrainingArguments
import json

# Beispiel-Modell und Tokenizer laden (T5 als Platzhalter)
model_name = "t5-small"
tokenizer = AutoTokenizer.from_pretrained(model_name)
model = AutoModelForSeq2SeqLM.from_pretrained(model_name)

# Trainingsdaten laden
with open("training_data.json", "r") as f:
    data = json.load(f)

# Beispiel: Trainingsdaten vorbereiten (dies ist ein Platzhalter, echte Implementierung erfordert ein Dataset)
def preprocess_data(data):
    inputs = [tokenizer(d["input"], return_tensors="pt", truncation=True, padding="max_length", max_length=64) for d in data]
    labels = [tokenizer(d["output"], return_tensors="pt", truncation=True, padding="max_length", max_length=64) for d in data]
    return inputs, labels

inputs, labels = preprocess_data(data)

# Trainingsparameter
training_args = TrainingArguments(
    output_dir="./results",
    num_train_epochs=3,
    per_device_train_batch_size=4,
    save_steps=10_000,
    save_total_limit=2,
)

# Platzhalter Trainer (echtes Training erfordert Anpassungen)
trainer = Trainer(
    model=model,
    args=training_args,
    train_dataset=inputs,  # Dies ist ein vereinfachtes Beispiel
)

trainer.train()
model.save_pretrained("ai_model")
